@extends('layouts.admin_layout')

@section('content')
    <div>
        <div class="alert alert-success">
            <i class="fa fa-check-circle"></i> {{ session('message') }}
        </div>
        @if($product)
            <div class="card">
                <div class="card-header">
                    <h4>Product Details</h4>
                </div>
                <div class="card-body">
                    <p><strong>Product Name:</strong> {{ $product->product_name }}</p>
                    <p><strong>Description:</strong> {{ $product->description }}</p>
                    <p><strong>Price:</strong> kes {{ $product->price }}</p>
                </div>
                <div class="card-footer">
                    <a href="{{ route('admin.bitdefender_products') }}" class="btn btn-primary">View All Products</a>
                </div>
            </div>
        @else
            <div class="alert alert-warning">
                <i class="fa fa-warning"></i> Product details are not available. Please try again later.
            </div>
        @endif
    </div>
@endsection