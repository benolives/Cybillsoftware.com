@extends('layouts.base')
@push('styles')
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
@endpush
@section('content')






<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
@if($cartItems->Count() > 0)
<div class="container" style="padding-top: 150px; padding-bottom: 50px;">
<table id="cart" class="table table-hover table-condensed">
  <thead>
    <tr>
      <th style="width:50%; color:#ee4e37;">Product</th>
      <th style="width:15%; color:#ee4e37;">Price</th>
      <th style="width:10%; color:#ee4e37;">Quantity</th>
      <th style="width:15%; color:#ee4e37;" >Subtotal</th>
      <th style="width:10%; color:#ee4e37;"></th>
    </tr>
  </thead>
  <tbody>
   @foreach($cartItems as $item)
    <tr>
      <td data-th="Product">
        <div class="row">
          <div class="col-sm-10">
            <h4 class="nomargin" style="color: black;">{{ $item->model->product_name }}</h4>
          </div>
        </div>
      </td>
      <td data-th="Price" style="color: green; font-weight: bold;">{{ $item->model->price_partner }}</td>
      <td data-th="Quantity">
        <input type="number" name="quantity" data-rowid="{{ $item->rowId }}" onchange="updateQuantity(this)"  class="form-control text-center" value="{{ $item->qty }}">
      </td>
      <td data-th="Subtotal" class="text-center"  style="color: black;">kshs {{ $item->subtotal() }}</td>
      <td class="actions" data-th="">
        <button class="btn btn-danger btn-sm"><i class="fa fa-trash-o" onclick="removeItemFromCart('{{ $item->rowId }}')"></i></button>
      </td>
    </tr>
   @endforeach
  </tbody>
  <tfoot>
    <tr class="visible-xs">
      <td colspan="5" class="text-center" style="color: #ee4e37;"><strong>Total Kshs {{ Cart::instance('cart')->total() }}</strong></td>
    </tr>
    <tr>
      <td colspan="2"><a href="{{ route('shop.index') }}" class="btn btn-warning"><i class='bx bx-chevron-left'></i>Continue Shopping</a></td>
      <td colspan="2" class="hidden-xs"></td>
      <td class="hidden-xs text-center" style="color: #ee4e37;" ><strong>Total Kshs {{ Cart::instance('cart')->total() }}</strong></td>
      
      <td>
      <!-- <a href="#" class="btn btn-success btn-block show-login">Checkout <i class='bx bx-chevron-right'></i></a> -->
        <a href="#" class="btn btn-success btn-block show-login"data-product-id="{{ $item->id }}">Checkout <i class='bx bx-chevron-right'></i></a>
      </td>
    </tr>
  </tfoot>
</table>



</div>
@else
    <div class="row d-flex justify-content-center" style="padding-top: 150px; padding-bottom: 50px; align-items: center;">
        <div class="col-md-12 text-center">
            <h2>Your cart is empty !</h2>
            <h5 class="mt-3">Add items to cart</h5>
            <a href="{{ route('shop.index') }}" class="btn btn-warning mt-5">Shop now</a>
        </div>
    </div>
@endif
<form action="{{ route('cart.update') }}" id="updateCartQty" method="POST">
  @csrf
  @method('put')
  <input type="hidden" id="rowId" name="rowId">
  <input type="hidden" id="quantity" name="quantity"> 
</form>

<form action="{{ route('cart.remove') }}" id="deleteFromCart" method="POST">
  @csrf
  @method('delete')
  <input type="hidden" id="rowId_D" name="rowId">
</form>

<form action="{{ route('cart.clear') }}" id="clearCart" method="post">
  @csrf
  @method('delete')
</form>

<!-- @foreach ($cartItems as $item) -->
          <div class="popup" data-product-id="{{ $item->id }}">
            <div class="close-btn">&times;</div>
            <form method="post" action="{{ route('processCheckout', ['productId' => $item->id]) }}">
               @csrf
               <div class="form">
                     <h2 style="color: #292663;">Checkout</h2>
                     <div class="form-element">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" placeholder="Enter email">
                     </div>
                     <div class="form-element">
                        <label for="number">Phone Number</label>
                        <input type="tel" name="phoneNumber" id="number" placeholder="Start with 254">
                     </div>
                     <input type="hidden" name="productId"  value="{{ $item->id }}">
                     <input type="hidden" name="quantity" value="{{ $item->qty }}">
                     <input type="hidden" name="productPrice" value="{{ (int) Cart::instance('cart')->total() }}">
                     
                     <!-- New Client Information Fields -->
                @if (session('success'))
            <div class="alert alert-success" style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 4px; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif
         <form action="{{ route('client.store') }}" method="POST" style="display: flex; flex-direction: column;">
        @csrf
        <div class="form-element">
            <label for="client_name">Client Name</label>
            <input type="text" name="client_name" id="client_name" placeholder="Enter Client Name" required>
        </div>
        <div class="form-element">
            <label for="client_email">Client Email</label>
            <input type="email" name="client_email" id="client_email" placeholder="Enter Client Email" required>
        </div>
        <div class="form-element">
            <label for="client_phone">Client Phone Number</label>
            <input type="text" name="client_phone" id="client_phone" placeholder="Enter Client Phone Number" required>
        </div>
        <div class="form-element">
            <label for="product_name">Product Name</label>
            <input type="text" name="product_name" id="product_name" value="{{ $item->name }}" readonly required>
        </div>
        <div class="form-element">
            <label for="product_price">Product Price</label>
            <input type="number" name="product_price" id="product_price" value="{{ $item->price }}" readonly required>
        </div>
        <div class="form-element">
            <label for="commission_received">Commission Earned</label>
            <input type="number" name="commission_received" id="commission_received" placeholder="Commission will be calculated automatically" readonly required>
        </div>
        <div class="form-element">
            <label for="subscription_type">Subscription Type</label>
            <select name="subscription_type" id="subscription_type" required>
                <option value="monthly">Monthly</option>
                <option value="annually">Annually</option>
            </select>
        </div>
                     <div class="form-element">
                        <!-- <button>Buy Now</button> -->
                        <button onclick="buyNow('{{ $item->id }}')">Buy Now</button>
                     </div>
               </div>
            </form>
          </div>
          <!-- @endforeach -->




@endsection

@push('scripts')
  <script>
  
  
  
    function updateQuantity(qty)
    {
      $('#rowId').val($(qty).data('rowid'));
      $('#quantity').val($(qty).val());
      $('#updateCartQty').submit();
    }

    function removeItemFromCart(rowId){
      $('#rowId_D').val(rowId);
      $('#deleteFromCart').submit();
    }

    function clearCart(){
      $('#clearCart').submit();
    }
    function buyNow(productId) {
    $('#checkoutForm_' + productId).submit();
    }
    
    function calculateCommission() {
        var productPrice = parseFloat(document.getElementById('product_price').value);
        var commissionRate = 0.20; // 20%
        var commission = productPrice * commissionRate;
        
        document.getElementById('commission_received').value = commission.toFixed(2);
    }

    // Calculate commission on page load
    window.onload = function() {
        calculateCommission();
    }
    
  </script>
@endpush