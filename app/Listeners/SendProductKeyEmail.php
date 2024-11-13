<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Mail;
use App\Models\ProductKeys;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Mail\KeyEmail;   
use App\Mail\OneKeyEmail;
use App\Events\PurchaseSuccessfull;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class SendProductKeyEmail implements ShouldQueue
{
    // use InteractsWithQueue;

    
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */

    //  public function handle(PurchaseSuccessfull $event)
    //  {
    //     $email = $event->email;
    //     $productId = $event->productId;
    //     $safaricomResponse = $event->safaricomResponse;

    //     // Fetch the key from the database using the product ID
    //     $productKey = ProductKeys::getKeyByProductId($productId);

    //     // dd($productKey);
    //     // Log::info($productKey);
    //     if ($productKey) {
    //         // Update the sold_status to 1
    //         $productKey->update(['sold_status' => true]);
    //         $productKey->save();

    //         // Send the key to the provided email
    //         Mail::to($email)->send(new KeyEmail($productKey->key_code));
    //     }
    //  }


    public function handle(PurchaseSuccessfull $event)
    {
        $email = $event->email;
        $productId = $event->productId;
        $safaricomResponse = $event->safaricomResponse;

        // Fetch the cart items from the database using the user's email
        $cartItems = Cart::instance('cart')->content();

        // Check if the cart is not empty
        if (!$cartItems->isEmpty()) {
            foreach ($cartItems as $item) {
                $productId = $item->id;
                $quantity = $item->qty;

                // Fetch the key from the database using the product ID
                $productKey = ProductKeys::getKeyByProductId($productId);

                if ($productKey) {
                    // Determine the key quantity based on the quantity selected
                    $keyQuantity = max(1, $quantity); // Assuming a minimum quantity of 1

                    // Update the sold_status to 1 and set the quantity
                    // $productKey->update(['sold_status' => true, 'quantity' => $keyQuantity]);
                    $productKey->update(['sold_status' => true]);

                    // Send the keys to the provided email
                    $this->sendKeysByEmail($email, $productId, $keyQuantity, $productKey->key_code, $item->model->product_name);
                }
            }
        } else {
            // If the cart is empty, handle the single key scenario
            $this->handleSingleKey($email, $productId);
        }
    }


    // public function handle(PurchaseSuccessfull $event)
    // {
    //     $email = $event->email;
    //     $productId = $event->productId;
    //     $safaricomResponse = $event->safaricomResponse;

    //     // Fetch the cart items from the database using the user's email
    //     $cartItems = Cart::instance('cart')->content();

    //     foreach ($cartItems as $item) {
    //         $productId = $item->id;
    //         $quantity = $item->qty;

    //         // Fetch the key from the database using the product ID
    //         $productKey = ProductKeys::getKeyByProductId($productId);

    //         if ($productKey) {
    //             // Determine the key quantity based on the quantity selected
    //             $keyQuantity = max(1, $quantity); // Assuming a minimum quantity of 1

    //             // Update the sold_status to 1 and set the quantity
    //             $productKey->update(['sold_status' => true, 'quantity' => $keyQuantity]);

    //             // Send the keys to the provided email
    //             $this->sendKeysByEmail($email, $productId, $keyQuantity, $productKey->key_code, $item->model->product_name);
    //         }
    //     }
    // }


    // protected function handleSingleKey($email, $productId)
    // {
    //     // Fetch the key from the database using the product ID
    //     $productKey = ProductKeys::getKeyByProductId($productId);

    //     if ($productKey) {
    //         // Update the sold_status to 1
    //         $productKey->update(['sold_status' => true]);

    //         // Assuming you have the necessary data to pass to KeyEmail constructor
    //         $mailData = [
    //             'email' => $email,
    //             'productId' => $productId,
    //             'keyQuantity' => 1, // or any other default value
    //             'keyCode' => $productKey->key_code,
    //             'productName' => $productKey->product->product_name,
    //         ];

    //         // Send the key to the provided email
    //         Mail::to($email)->send(new KeyEmail($mailData, []));
    //     }
    // }

    protected function handleSingleKey($email, $productId, $keyQuantity = 1)
    {
        // Fetch the unsold keys from the database using the product ID
        $productKeys = ProductKeys::where('product_id', $productId)
            ->where('sold_status', false) // Only fetch unsold keys
            ->limit($keyQuantity) // Limit the number of keys based on the specified quantity
            ->get();

        foreach ($productKeys as $productKey) {
            // Update the sold_status to 1 for each fetched key
            $productKey->update(['sold_status' => true]);

            // Assuming you have the necessary data to pass to KeyEmail constructor
            $mailData = [
                'email' => $email,
                'productId' => $productId,
                'keyQuantity' => 1, // or any other default value
                'keyCode' => $productKey->key_code,
                'productName' => $productKey->product->product_name,
                'link' => $productKey->product_link,
            ];

            // Send each key to the provided email
            Mail::to($email)->send(new KeyEmail($mailData, []));
        }
    }




    // public function sendKeysByEmail($email, $productId, $keyQuantity, $keyCode, $productName)
    // {
    //     // Fetch the product keys from the database using the product ID
    //     $productKeys = ProductKeys::where('product_id', $productId)
    //         ->where('sold_status', false) // Only fetch unsold keys
    //         ->limit($keyQuantity) // Limit the number of keys based on the specified quantity
    //         ->get(); 

    //     // Your logic to send keys by email
    //     // This could involve sending emails or any other desired action

    //     // Assuming you have a Mailable class named KeyEmail
    //     $mailData = [
    //         'email' => $email,
    //         'productId' => $productId,
    //         'keyQuantity' => $keyQuantity,
    //         'keyCode' => $keyCode,
    //         'productName' => $productName,
    //         'productKeys' => $productKeys,
    //     ];

    //     // Send email
    //     Mail::to($email)->send(new KeyEmail($mailData['keyCode'], $mailData['productKeys']));

    //     // You can add more custom logic here, such as logging or additional processing
    //     // For now, just printing a message
    //     echo "Sending $keyQuantity keys for Product ID $productId to $email with key code $keyCode and product name $productName via email.";
    // }

    public function sendKeysByEmail($email, $productId, $keyQuantity, $keyCode, $productName)
    {
        // Fetch the product keys from the database using the product ID
        $productKeys = ProductKeys::where('product_id', $productId)
            ->where('sold_status', false) // Only fetch unsold keys
            ->limit($keyQuantity) // Limit the number of keys based on the specified quantity
            ->get(); 

        // Your logic to send keys by email
        // This could involve sending emails or any other desired action

        // Assuming you have a Mailable class named KeyEmail
        foreach ($productKeys as $productKey) {
            // Update the sold_status to 1 for each fetched key
            $productKey->update(['sold_status' => true]);

            $mailData = [
                'email' => $email,
                'productId' => $productId,
                'keyQuantity' => $keyQuantity,
                'keyCode' => $productKey->key_code,
                'productName' => $productName,
                'link' => $productKey->product_link,
                'productKeys' => $productKeys,
            ];

            // Send email for each key
        Mail::to($email)->send(new PurchaseConfirmation($productId, $safaricomResponse));

            // You can add more custom logic here, such as logging or additional processing
            // For now, just printing a message
            echo "Sending $keyQuantity keys for Product ID $productId to $email with key code $keyCode and product name $productName via email.";
        }
    }









    // public function handle(object $event): void
    // {
    //     //
    // }
}