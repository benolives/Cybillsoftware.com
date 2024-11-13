@extends('layouts.base')
@push('styles')
@endpush
@section('content')

    <!--==================== HOME ====================-->
    <section class="home" style="height: 100%;">
            <div class="home__container container">
               <div class="home__content">
                  <!-- <h3 class="home__subtitle">
                     SECURITY SOFTWARE
                  </h3> -->

                  <h1 class="home__title">
                     <span style="color: #292663;">
                        Shop Now for <br>
                        Peace of Mind! 
                     </span>

                     <img src="assets/img/line.svg" alt="">
                  </h1>

                  <p class="home__description" style="margin-bottom: 10px;">
                    🔐 Unmatched Antivirus Protection <br style="margin-bottom: 10px;">
                    🚀 Lightning-Fast Performance <br style="margin-bottom: 10px;">
                    🌐 Secure Your Online World Today <br style="margin-bottom: 10px;">
                    👩‍💻 Advanced Parental control <br>
                  </p>

                  <!-- <a href="#" class="home__button">
                     Buy Now
                  </a> -->
               </div>

               <div class="home__images">
                  <img src="assets/img/points-space.svg" alt="Cybill software" class="home__points">
                  <!-- <img src="assets/img/planet.svg" alt="Cybill software" class="home__planet-2"> -->
                  <!-- <img src="assets/img/planet.svg" alt="Cybill software" class="home__planet-1"> -->
                  <img src="assets/img/20945597.svg" alt="Cybill software" class="home__rocket" style="height: 100%;">
               </div>

               <!-- <img src="assets/img/clouds-1.svg" alt="cybill" class="home__cloud-1">
               <img src="assets/img/clouds-2.svg" alt="cybill" class="home__cloud-2">  -->

            </div>
         </section>

           <!--Pricing Container -->
<section class="pricing__container">
   <h2 class="pricing__heading">
      Pricing
   </h2>
   <div class="tab-nav-bar">
      <div class="tab-navigation">
         <!-- Display categories -->
         <ul class="tab-menu">
            @foreach ($categories as $key => $category)
               <li class="tab-btn @if ($key === 0) active @endif" data-category="{{ $category->id }}">{{ $category->name }}</li>
            @endforeach
         </ul>
      </div>
   </div>

   @foreach ($categories as $key => $category)
      <div class="price-plan tab @if ($key === 0) active @endif" id="price-plan-{{ $category->id }}">
         <!--Box one-->
         @foreach ($category->products as $product)
            <div class="price-box">
               <div class="top-box" id="box1">
                  <div class="price-card-image">
                     <img src="{{ Storage::url($product->image_url) }}" alt="" class="card-img">
                  </div>
                  <h2 class="p-name single">{{ $product->product_name }}</h2>
                  <h2 class="price">
                     @auth
                        {{ $product->price_partner }}Kshs
                     @else
                        {{ $product->price }}Kshs
                     @endauth
                  </h2>
                  @if(!auth()->check())
                     <h2 class="price" style="font-size: large;">
                        <del>{{ $product->price_offer }}Kshs</del>
                     </h2>
                  @endif

                  @if(auth()->check())
                     <!-- <a href="#" class="btn single-btn">Add to cart</a> -->
                     <form action="{{ route('cart.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <input type="hidden" name="quantity" id="qty" value="1"> <!-- You can change this as needed -->
                        <button type="submit" class="btn single-btn">Add to cart</button>
                    </form>
                  @else
                     <!-- <a href="#" class="btn single-btn">Quick Checkout</a> -->
                     <a href="#" class="btn single-btn show-login" data-product-id="{{ $product->id }}">Quick Checkout</a>
                  @endif

      
                  <!-- <a href="" class="btn single-btn">Add to cart</a>
                  <a href="" class="btn single-btn">Quick Checkout</a>  -->
               </div>
               <div class="bottom-box">
                  @foreach ($product->features as $feature)
                     <div class="p-box">
                        <i class='bx bx-check'></i>
                        <p>{{ $feature->description }}</p>
                     </div>
                  @endforeach
               </div>
            </div>
         @endforeach
      </div>
   @endforeach
</section> 

 <!---- HTML MODAL -->
          
 @foreach ($products as $product)
    <div class="popup" data-product-id="{{ $product->id }}">
        <div class="close-btn">&times;</div>
        <form method="post" action="{{ route('processCheckout', ['productId' => $product->id]) }}">
            @csrf
            <div class="form">
                <h2 style="color: #292663;">Checkout</h2>
                
                <!-- Existing Fields -->
                <div class="form-element">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" placeholder="Enter email">
                </div>
                <div class="form-element">
                    <label for="number">Phone Number</label>
                    <input type="number" name="phoneNumber" id="number" placeholder="Enter Phone Number">
                </div>
                
                <!-- Hidden Inputs for Product -->
                <input type="hidden" name="productId" value="{{ $product->id }}">
                <input type="hidden" name="productPrice" value="{{ $product->price }}">
                
                <!-- New Client Information Fields -->
                @if (session('success'))
            <div class="alert alert-success" style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 4px; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif
        <form action="{{ route('client.store') }}" method="POST" style="display: flex; flex-direction: column;">
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
                    <input type="text" name="product_name" id="product_name" value="{{ $product->name }}"  readonlyrequired>
                </div>
                <div class="form-element">
                    <label for="product_price">Product Price</label>
                    <input type="number" name="product_price" id="product_price" value="{{ $product->price }}" readonly required>
                </div>
                <div class="form-element">
                    <label for="commission_received">Commission Earned</label>
                    <input type="number" name="commission_received" id="commission_received" placeholder="Enter Commission Earned" required>
                </div>
                <div class="form-element">
                    <label for="subscription_type">Subscription Type</label>
                    <select name="subscription_type" id="subscription_type" required>
                        <option value="monthly">Monthly</option>
                        <option value="annually">Annually</option>
                    </select>
                </div>

                <!-- Submit Button -->
                <div class="form-element">
                    <button>Buy Now</button>
                </div>
            </div>
        </form>
    </div>
@endforeach

          







@endsection