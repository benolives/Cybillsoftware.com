@extends('layouts.admin_layout')

@section('content')
<!-- Notification Div -->
@if(session('success') || session('error'))
    <div 
        data-notify="container" 
        class="col-10 col-xs-11 col-sm-4 alert @if(session('success')) alert-success @else alert-danger @endif" 
        role="alert" 
        data-notify-position="top-center" 
        style="display: inline-block; margin: 0px auto; padding-left: 65px; position: fixed; transition: 0.5s ease-in-out; z-index: 1031; top: 20px; left: 0px; right: 0px;">
        <button type="button" aria-hidden="true" class="close" data-notify="dismiss" style="position: absolute; right: 10px; top: 5px; z-index: 1033;">
            ×
        </button>
        <span data-notify="icon" class="none"></span> 
        <span data-notify="title">{{ session('success') ? 'Success' : 'Error' }}</span> 
        <span data-notify="message">{{ session('success') ?? session('error') }}</span>
    </div>
@endif
<div class="page-header">
    <h3 class="fw-bold mb-3">Forms</h3>
    <ul class="breadcrumbs mb-3">
        <li class="nav-home">
            <a href="{{ route('admin.dashboard') }}">
                <i class="fas fa-home"></i>
            </a>
        </li>
        <li class="separator">
            <i class="fa-solid fa-chevron-right"></i>
        </li>
        <li class="nav-item">
            <a href="#">Forms</a>
        </li>
        <li class="separator">
            <i class="fa-solid fa-chevron-right"></i>
        </li>
        <li class="nav-item">
            <a href="#">New partner form</a>
        </li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">New Partner Details</div>
            </div>
            <div class="card-body">
                <!-- Form Starts Here -->
                <form action="{{ route('admin.add_new_partner') }}" method="POST">
                    @csrf <!-- CSRF Token -->
                    <div class="row">
                        <!-- Column 1: Left Side (Name, Email, Company) for Desktop screen-->
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input
                                    type="text"
                                    class="form-control @error('name') is-invalid @enderror"
                                    id="name"
                                    name="name"
                                    value="{{ old('name') }}"
                                    placeholder="Enter Name"
                                />
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="input-icon">
                                    <input
                                        type="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        id="email"
                                        name="email"
                                        value="{{ old('email') }}"
                                        placeholder="Enter Email"
                                    />
                                    <small class="form-text text-muted">
                                        We'll never share your email with anyone else.
                                    </small>
                                </div>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="company">Name of Company</label>
                                <input
                                    type="text"
                                    class="form-control @error('company') is-invalid @enderror"
                                    id="company"
                                    name="company"
                                    value="{{ old('company') }}"
                                    placeholder="Enter Name of Company"
                                />
                                @error('company')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Column 2: Right Side (Phone, Password, Confirm Password) -->
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <input
                                    type="text"
                                    class="form-control @error('phone') is-invalid @enderror"
                                    id="phone"
                                    name="phone"
                                    value="{{ old('phone') }}"
                                    placeholder="Enter your Phone number"
                                />
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input
                                    type="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    id="password"
                                    name="password"
                                    placeholder="Password"
                                />
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Confirm Password</label>
                                <input
                                    type="password"
                                    class="form-control @error('confirm_password') is-invalid @enderror"
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    placeholder="Confirm Password"
                                />
                                @error('confirm_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-action">
                        <button type="submit" class="btn btn-success">Submit</button>
                        <button type="reset" class="btn btn-danger">Cancel</button>
                    </div>
                </form>
                <!-- Form Ends Here -->
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        // Wait for DOM to be fully loaded
        document.addEventListener('DOMContentLoaded', function() {
            const notifyContainer = document.querySelector('[data-notify="container"]');
            
            if (notifyContainer) {
                // Add class 'show' to make the notification appear smoothly
                notifyContainer.classList.add('show');
                
                // Automatically close the notification after 5 seconds
                setTimeout(function() {
                    // Add class 'hide' to make the notification fade out smoothly
                    notifyContainer.classList.remove('show');
                    notifyContainer.classList.add('hide');
                }, 5000);
            }
        });
    </script>
@endpush