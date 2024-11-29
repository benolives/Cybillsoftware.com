@extends('layouts.admin_layout')

@section('content')
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
                <form action="#" method="POST">
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
                                    id="confirm_password"
                                    name="confirm_password"
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