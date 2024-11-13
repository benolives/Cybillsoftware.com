@extends('layouts.base')

<!-- resources/views/modal.blade.php -->
@foreach ($products as $product)
@include('modal', ['product' => $product])

<div class="popup" data-product-id="{{ $product->id }}">
    <div class="close-btn">&times;</div>
    <form method="post" action="{{ route('processCheckout', ['productId' => $product->id]) }}">
        @csrf
        <div class="form">
            <h2 style="color: #292663;">Checkout</h2>
            <div class="form-element">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" placeholder="Enter email">
            </div>
            <div class="form-element">
                <label for="number">Phone Number</label>
                <input type="tel" name="phoneNumber" id="number" placeholder="Enter Phone Number">
            </div>
            <input type="hidden" name="productId" value="{{ $product->id }}">
            <div class="form-element">
                <button>Buy Now</button>
            </div>
        </div>
    </form>
</div>
@endforeach


<!-- <div class="popup" data-product-id="{{ $product->id }}">
    <div class="close-btn">&times;</div>
    <form method="post" action="{{ route('processCheckout', ['productId' => $product->id]) }}">
        @csrf
        <div class="form">
            <h2 style="color: #292663;">Checkout</h2>
            <div class="form-element">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" placeholder="Enter email">
            </div>
            <div class="form-element">
                <label for="number">Phone Number</label>
                <input type="number" name="phoneNumber" id="number" placeholder="Enter Phone Number">
            </div>
            <input type="hidden" name="productId" value="{{ $product->id }}">
            <div class="form-element">
                <button>Buy Now</button>
            </div>
        </div>
    </form>
</div> -->