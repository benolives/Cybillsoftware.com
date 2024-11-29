<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

use App\Models\KasperskyProduct;
use App\Models\Product;
use App\Models\Category;

class KasperskyBenOlivesApiService
{
    protected $consumerKey = 'e841bae8-8ee4-47d8-b052-24f7a59513ef';
    protected $consumerSecret = '36f678ca-65fe-4471-978d-d2a9b42dfedf';
    protected $accessToken;
    protected $accessTokenExpiry;
    

    // Get OAuth access Token with Base64 Encoding if consumer secret, key
    public function getAccessToken()
    {
       // Check if we already have a valid access token that has not expired
       // if the token is valid we will use it
       if ($this->accessToken && $this->accessTokenExpiry > Carbon::now()){
            return $this->accessToken;
        }

        // Generate a timesptamp using the carbon package
        $timestamp = Carbon::now()->timestamp;

        //create a string of the consumerKey, consumerSecret,that we will
        // then encode to base64
        $stringToEncode = $this->consumerKey . ':' . $this->consumerSecret;

        // Base64 encode the string to send to Endpoint
        $encodedCredentials = base64_encode($stringToEncode);

        // Send request to generate access token with Base64 encoded credentials in Authorization header
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Basic ' . $encodedCredentials,
                'Content-Type' => 'application/json',
            ])->get('https://kaspersky.benolives.co.ke/api/OAuth/generate?grant_type=client_credentials');
            
            if ($response->successful()) {
                $data = $response->json();
                //assign the access token
                $this->accessToken = $data['access_token'];
                // Set the token expiry time (3600 seconds = 1 hour) because that what's kasperskyBenolives endpoint specifies
                $this->accessTokenExpiry = Carbon::now()->addSeconds(3600);
                return $this->accessToken;
            } else {
                // Log error response (for debugging)
                Log::error('OAuth Token Error', ['response' => $response->body()]);
            }
        } catch (\Exception $e) {
            Log::error('Error retrieving access token: ' . $e->getMessage());
            return null;
        }
    }

    // This function will be used to retrieve the products from KasperskyBenOlives endpoint
    public function getPartnerProducts()
    {
        //obtain the access token
        $token = $this->getAccessToken();

        // Use the token to make the API request
        try {
            $response = Http::withToken($token)->get('https://kaspersky.benolives.co.ke/api/PartnerApis/GetPartnerProducts');
            if ($response->successful()) {
                return $response->json();
            } else {
                // Log error response (for debugging)
                Log::error('Get Products Error', ['response' => $response->body()]);
            }
        } catch (\Exception $e) {
            Log::error('Error retrieving partner products: ' . $e->getMessage());
            return null;
        }
    }

    //calculate price to sell to customers based on original price and profit margin
    private function calculatePriceWithProfit($basePrice, $profitMargin)
    {
        // Add profit margin to the base price
        return $basePrice + ($basePrice * $profitMargin / 100);
    }

    //calculate the price for our partner based on our price and their commission
    private function calculatePartnerPrice($price, $partnerCommission)
    {
        // Calculate the price for the partner by reducing the commission percentage
        return $price - ($price * $partnerCommission / 100);
    }

    // Fetch products from Kaspersky BenOlives API and store/update in our DB SO
    // that both artisan command/cronjob and controllers can use this method.
    public function fetchKasperskyProductsAndStoreInDB()
    {
        // Fetch the products from the KasperskyBenOlives API
        $products = $this->getPartnerProducts();

        // Define the profit margin and partner commission percentage
        // these values will be adjustible
        $profitMarginPercentage = 25;
        $partnerCommissionPercentage = 7;

        foreach ($products as $product) {
            //add the relationship with category
            $categorySlug = 'kaspersky';

            // Find the category ID using the category slug
            $category = Category::where('slug', $categorySlug)->first();

            if (!$category) {
                Log::error('Category not found for product: ' . $product['name']);
                return;
            }

            // Calculate the new prices
            $ourPrice = $this->calculatePriceWithProfit($product['price'], $profitMarginPercentage);
            $priceForPartner = $this->calculatePartnerPrice($ourPrice, $partnerCommissionPercentage);

            // Check if the product already exists in the DB
            $existingProduct = Product::where('product_api_id', $product['id'])->first();

            Log::info('PRODUCT ID: ' . $product['id']);
            if ($existingProduct) {
                // Update existing product
                $existingProduct->update([
                    'product_name' => $product['name'],
                    'product_plan_name' => 'kaspersky plan',
                    'price' => $ourPrice,
                    'price_offer' => $product['price'],
                    'price_partner' => $priceForPartner,
                    'commission_percentage' => $partnerCommissionPercentage,
                    'description' => $product['description'] ?? 'kaspersky security product',
                    'last_updated_at' => now(),
                    'category_id' => $category->id,
                    'product_api_id' => $product['id'],
                ]);
            } else {
                // Insert new product
                Product::create([
                    'product_name' => $product['name'],
                    'product_plan_name' => 'kaspersky plan',
                    'description' => $product['description'] ?? 'kaspersky security product',
                    'price' => $ourPrice,
                    'price_offer' => $product['price'],
                    'price_partner' => $priceForPartner,
                    'commission_percentage' => $partnerCommissionPercentage,
                    'last_updated_at' => now(),
                    'category_id' => $category->id,
                    'product_api_id' => $product['id'],
                ]);
            }
        }
        Log::info('Kaspersky products fetched and stored in products table successfully.');
        return true; // to indicate success.
    }

    public function createSubscription($productId, $subscriberId)
    {
        try {
            // Get access token
            $token = $this->getAccessToken();

            // Make the API request
            $response = Http::withToken($token)
                ->post("https://kaspersky.benolives.co.ke/api/PartnerApis/CreateSubscriberProduct", [
                    'ProductId' => $productId,
                    'SubscriberId' => $subscriberId,
                ]);

            // Log the response for debugging purposes
            Log::info('CreateSubscription Response:', [
                'product_id' => $productId,
                'subscriber_id' => $subscriberId,
                'status_code' => $response->status(),
                'response_body' => $response->body(),
            ]);

            // Check if the response is successful
            if ($response->successful()) {
                return $response->json();
            }

            // Log and throw an exception if the response is not successful
            Log::error('CreateSubscription Failed:', [
                'product_id' => $productId,
                'subscriber_id' => $subscriberId,
                'status_code' => $response->status(),
                'response_body' => $response->body(),
            ]);
        } catch (\Exception $e) {
            // Log any exception that occurs
            Log::error('CreateSubscription Exception:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            // throw the exception
            throw $e;
        }
    }
}
