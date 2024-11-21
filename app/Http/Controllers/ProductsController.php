<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Services\KasperskyBenOlivesApiService;
//import the Product model so that we can use it to fetch the products from db
use App\Models\Product;
use App\Models\Category;
use App\Models\KasperskyProduct;
use Illuminate\Support\Facades\Auth;


class ProductsController extends Controller
{
    protected $kasperskyService;

    public function __construct(KasperskyBenOlivesApiService $kasperskyService)
    {
        $this->kasperskyService = $kasperskyService;
    }

    // Show the available products we have in our catalog so that partners can choose
    // what they want. For now they will choose btn bitdefender or Kaspersky or all
    public function showAvailableProducts()
    {
        return view('products.select-products');
    }
    public function showProductsPage()
    {
        //fetch products from database for now or return 404 error
        $products = Product::all();

        // Log the retrieved products for debugging purposes
        Log::info('Retrieved products:', ['products' => $products]);


        /*
            compact('products'): This function creates an associative array containing variables 
            that are passed to the view. In this case, it takes the variable $products 
            and creates an array with the key 'products' and the value being the content of
            the $products variable.
        */
        return view('products.index', compact('products'));
    }

    // Show the Kaspersky products by retrieving the products from kaspersky db
    public function showKasperskyProducts()
    {
        try {
            // Retrieve the Kaspersky category based on its slug
            $category = Category::where('slug', 'kaspersky')->firstOrFail();
        
            // Retrieve the products related to the Kaspersky category
            $kasperskyProducts = Product::where('category_id', $category->id)->get();
        
            if ($kasperskyProducts->isEmpty()) {
                // Log an error if no products are found and show a user-friendly message
                Log::error('No Kaspersky products found in the database');
                return view('errors.custom_error', ['errorMessage' => 'No Kaspersky products available at this time.']);
            }
        
            // Log the products for debugging purposes (optional, sensitive data should be sanitized if necessary)
            Log::info('Fetched Kaspersky products from the database', ['products_count' => $kasperskyProducts->count()]);
        
            // Return the view with the products
            return view('products.kaspersky', compact('kasperskyProducts'));
        
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Handle the case where the category is not found
            Log::error('Kaspersky category not found: ' . $e->getMessage());
            return view('errors.custom_error', ['errorMessage' => 'Kaspersky category not found.']);
        } catch (\Exception $e) {
            // Catch any other exceptions and log them
            Log::error('Error fetching Kaspersky products from the database: ' . $e->getMessage());
            return view('errors.custom_error', ['errorMessage' => 'An error occurred while fetching Kaspersky products.']);
        }        
    }

    // Show specific Kaspersky product depending on Id received
    public function showSpecificKasperskyProduct($id)
    {
        try {
            // Validate that the id is a positive integer
            if (!is_numeric($id) || $id <= 0) {
                return view('errors.custom_error', ['errorMessage' => 'Invalid product ID provided.']);
            }

            // Fetch the product from the database using the ID
            // Using 'product_api_id' to match the ID
            $product = Product::where('product_api_id', $id)->first();

            // If no product is found with the provided ID
            if (!$product) {
                Log::error("Product with ID {$id} not found in the database.");
                return view('errors.custom_error', ['errorMessage' => 'Product not found in the database.']);
            }

            // If the product is found, return the specific product view
            return view('products.specific_kaspersky_product', compact('product'));

        } catch (\Exception $e) {
            // Log the error with exception details
            Log::error("Error fetching Kaspersky product with ID {$id}: " . $e->getMessage(), ['exception' => $e]);
            return view('errors.custom_error', ['errorMessage' => 'An error occurred while fetching the Kaspersky product.']);
        }
    }


    //retrieve the bitdefender products only
    public function showBitdefenderProducts()
    {
        try {
            // Retrieve the bitdefender category based on its slug
            $category = Category::where('slug', 'bitdefender')->firstOrFail();
        
            // Retrieve the products related to the bitdefender category
            $bitdefenderProducts = Product::where('category_id', $category->id)->get();
        
            if ($bitdefenderProducts->isEmpty()) {
                // Log an error if no products are found and show a user-friendly message
                Log::error('No Kaspersky products found in the database');
                return view('errors.custom_error', ['errorMessage' => 'No Bitdefender products available at this time.']);
            }
        
            // Log the products for debugging purposes (optional, sensitive data should be sanitized if necessary)
            Log::info('Fetched  Bitdefender products from the database', ['products_count' => $bitdefenderProducts->count()]);
        
            // Return the view with the products
            return view('products.bitdefender', compact('bitdefenderProducts'));
        
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Handle the case where the category is not found
            Log::error('Bitdefender category not found: ' . $e->getMessage());
            return view('errors.custom_error', ['errorMessage' => 'Bitdefender category not found.']);
        } catch (\Exception $e) {
            // Catch any other exceptions and log them
            Log::error('Error fetching Bitdefender products from the database: ' . $e->getMessage());
            return view('errors.custom_error', ['errorMessage' => 'An error occurred while fetching Bitdefender products.']);
        }
    }

    public function showSpecificProduct($id)
    {
        // Retrieve the product by its ID
        $product = Product::findOrFail($id);

        // Return a view and pass the product data to it
        return view('products.specificProduct', compact('product'));
    }
    
    //This is the method that will trigger and show the receipt to the buyer once they decide
    // to buy the product by clicking by now.
    public function showReceipt($id)
    {
        try {
            // Validate that the id is a positive integer
            if (!is_numeric($id) || $id <= 0) {
                return view('errors.custom_error', ['errorMessage' => 'Invalid product ID provided.']);
            }
    
            // Retrieve the product from the database using product_api_id
            $product = Product::where('product_api_id', $id)->first();
    
            // Check if the product is found
            if (!$product) {
                Log::error('Product not found in the database', ['product_api_id' => $id]);
                return view('errors.custom_error', ['errorMessage' => 'Product not found.']);
            }
    
            // If product is found, return the receipt view
            return view('products.receipt', compact('product'));
    
        } catch (\Exception $e) {
            // Log the error with additional exception details
            Log::error('Error retrieving Kaspersky product: ' . $e->getMessage(), ['exception' => $e]);
            return view('errors.custom_error', ['errorMessage' => 'An error occurred while fetching the product details.']);
        }
    }
}
