<?php

namespace App\Http\Controllers;

// use Gloudemans\Shoppingcart\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
// use Cart;


class CartController extends Controller
{
    //
    // public function increaseQuantity($rowId)
    // {
    //     $product = Cart::get($rowId);
    //     $qty = $product->qty + 1;
    //     Cart::update($rowId, $qty); 
    // }

    public function index()
    {
        $cartItems = Cart::instance('cart')->content();
        return view('cart', ['cartItems' => $cartItems]);
    }

    public function addToCart(Request $request)
    {
        $product = Product::find($request->id);
        $price = auth()->check() ? $product->price_partner : $product->price;
        Cart::instance('cart')->add($product->id, $product->product_name, $request->quantity, $price )->associate('App\Models\Product');
        return redirect()->back()->with('message', 'Success ! Item has been added to cart successfully');
    }

    public function updateCart(Request $request)
    {
        Cart::instance('cart')->update($request->rowId,$request->quantity);
        return redirect()->route('cart.index');
    }

    public function removeItem(Request $request)
    {
        $rowId = $request->rowId;
        Cart::instance('cart')->remove($rowId);
        return redirect()->route('cart.index');
    }

    public function clearCart()
    {
        Cart::instance('cart')->destroy();
        return redirect()->route('cart.index');
    }
}