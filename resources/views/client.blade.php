@extends('layouts.base')
@push('styles')
@endpush
@section('content')

<div class="container mt-5">
    <section class="section client-info" style="background-color: #ffffff; padding: 40px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); max-width: 600px; margin: 0 auto; margin-bottom: 40px;">
        <h2 style="text-align: center; color: #292663; font-size: 24px; margin-bottom: 20px;">Client Information</h2>
        @if (session('success'))
            <div class="alert alert-success" style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 4px; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif
        <form action="{{ route('client.store') }}" method="POST" style="display: flex; flex-direction: column;">
            @csrf
            <div class="form-group" style="margin-bottom: 20px;">
                <label for="client_name" style="display: block; font-weight: bold; margin-bottom: 8px; color: #292663; font-size: 16px;">Client Name</label>
                <input type="text" name="client_name" id="client_name" class="form-control" style="width: 100%; padding: 12px; border: 1px solid #e1e5ec; border-radius: 4px; box-sizing: border-box;" required>
            </div>
            <div class="form-group" style="margin-bottom: 20px;">
                <label for="client_email" style="display: block; font-weight: bold; margin-bottom: 8px; color: #292663; font-size: 16px;">Client Email</label>
                <input type="email" name="client_email" id="client_email" class="form-control" style="width: 100%; padding: 12px; border: 1px solid #e1e5ec; border-radius: 4px; box-sizing: border-box;" required>
            </div>
            <div class="form-group" style="margin-bottom: 20px;">
                <label for="client_phone" style="display: block; font-weight: bold; margin-bottom: 8px; color: #292663; font-size: 16px;">Client Phone Number</label>
                <input type="text" name="client_phone" id="client_phone" class="form-control" style="width: 100%; padding: 12px; border: 1px solid #e1e5ec; border-radius: 4px; box-sizing: border-box;" required>
            </div>
            <div class="form-group" style="margin-bottom: 20px;">
                <label for="product_name" style="display: block; font-weight: bold; margin-bottom: 8px; color: #292663; font-size: 16px;">Product Name</label>
                <input type="text" name="product_name" id="product_name" class="form-control" style="width: 100%; padding: 12px; border: 1px solid #e1e5ec; border-radius: 4px; box-sizing: border-box;" required>
            </div>
            <div class="form-group" style="margin-bottom: 20px;">
                <label for="product_price" style="display: block; font-weight: bold; margin-bottom: 8px; color: #292663; font-size: 16px;">Product Price</label>
                <input type="number" name="product_price" id="product_price" class="form-control" style="width: 100%; padding: 12px; border: 1px solid #e1e5ec; border-radius: 4px; box-sizing: border-box;" required>
            </div>
            <div class="form-group" style="margin-bottom: 20px;">
                <label for="commission_received" style="display: block; font-weight: bold; margin-bottom: 8px; color: #292663; font-size: 16px;">Commission Received</label>
                <input type="number" name="commission_received" id="commission_received" class="form-control" style="width: 100%; padding: 12px; border: 1px solid #e1e5ec; border-radius: 4px; box-sizing: border-box;" required>
            </div>
 
            <div class="form-group" style="margin-bottom: 20px;">
                <label for="subscription_type" style="display: block; font-weight: bold; margin-bottom: 8px; color: #292663; font-size: 16px;">Subscription Type</label>
                <select name="subscription_type" id="subscription_type" class="form-control" style="width: 100%; padding: 12px; border: 1px solid #e1e5ec; border-radius: 4px; box-sizing: border-box;" required>
                    <option value="monthly">Monthly</option>
                    <option value="annually">Annually</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary" style="background-color: #292663; color: #ffffff; border: none; padding: 12px; border-radius: 4px; cursor: pointer; font-size: 16px; text-align: center; width: 100%;">Save Client</button>
        </form>
    </section>
</div>

@endsection