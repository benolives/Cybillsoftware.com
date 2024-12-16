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
            <a href="#">New bitdefender product</a>
        </li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Bitdefender Product Details</div>
            </div>
            <div class="card-body">
                <!-- Form Starts Here -->
                <form action="{{ route('admin.post_bitdefender_new_product') }}" method="POST">
                    @csrf <!-- CSRF Token -->
                    <div class="row">
                        <!-- Column 1: Left Side -->
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="product_name">Product Name</label>
                                <input
                                    type="text"
                                    class="form-control @error('product_name') is-invalid @enderror"
                                    id="product_name"
                                    name="product_name"
                                    value="{{ old('product_name') }}"
                                    placeholder="Enter Product Name"
                                    required
                                />
                                @error('product_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea
                                    class="form-control @error('description') is-invalid @enderror"
                                    id="description"
                                    name="description"
                                    placeholder="Enter Product Description"
                                    rows="3"
                                >{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="discount_percentage">Discount Percentage</label>
                                <input
                                    type="text"
                                    class="form-control @error('discount_percentage') is-invalid @enderror"
                                    id="discount_percentage"
                                    name="discount_percentage"
                                    value="{{ old('discount_percentage') }}"
                                    placeholder="Enter Discount Percentage"
                                />
                                @error('discount_percentage')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="compatibility">Compatibility</label>
                                <div class="btn-group d-flex flex-wrap" role="group" aria-label="Compatibility">
                                    <label class="btn btn-outline-secondary">
                                        <input
                                            type="checkbox"
                                            class="compatibility-checkbox"
                                            name="compatibility[]"
                                            value="android"
                                        />
                                        Android
                                    </label>
                                    <label class="btn btn-outline-secondary">
                                        <input
                                            type="checkbox"
                                            class="compatibility-checkbox"
                                            name="compatibility[]"
                                            value="macos"
                                        />
                                        macOS
                                    </label>
                                    <label class="btn btn-outline-secondary">
                                        <input
                                            type="checkbox"
                                            class="compatibility-checkbox"
                                            name="compatibility[]"
                                            value="windows"
                                        />
                                        Windows
                                    </label>
                                    <label class="btn btn-outline-secondary">
                                        <input
                                            type="checkbox"
                                            class="compatibility-checkbox"
                                            name="compatibility[]"
                                            value="linux"
                                        />
                                        Linux
                                    </label>
                                    <label class="btn btn-outline-secondary">
                                        <input
                                            type="checkbox"
                                            class="compatibility-checkbox"
                                            name="compatibility[]"
                                            value="ios"
                                        />
                                        iOS
                                    </label>
                                </div>
                                @error('compatibility')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Column 2: Right Side -->
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input
                                    type="text"
                                    class="form-control @error('price') is-invalid @enderror"
                                    id="price"
                                    name="price"
                                    value="{{ old('price') }}"
                                    placeholder="Enter Product Price"
                                    required
                                />
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="price_offer">Price Offer (Optional)</label>
                                <input
                                    type="number"
                                    class="form-control @error('price_offer') is-invalid @enderror"
                                    id="price_offer"
                                    name="price_offer"
                                    value="{{ old('price_offer') }}"
                                    placeholder="Enter Price Offer"
                                />
                                @error('price_offer')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="stock_status">Stock Status</label>
                                <select
                                    class="form-control @error('stock_status') is-invalid @enderror"
                                    id="stock_status"
                                    name="stock_status"
                                >
                                    <option value="instock" {{ old('stock_status') == 'instock' ? 'selected' : '' }}>In Stock</option>
                                    <option value="outofstock" {{ old('stock_status') == 'outofstock' ? 'selected' : '' }}>Out of Stock</option>
                                </select>
                                @error('stock_status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="commission_percentage">Commission Percentage</label>
                                <input
                                    type="number"
                                    class="form-control @error('commission_percentage') is-invalid @enderror"
                                    id="commission_percentage"
                                    name="commission_percentage"
                                    value="{{ old('commission_percentage') }}"
                                    placeholder="Enter Commission Percentage"
                                />
                                @error('commission_percentage')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="slug">Slug</label>
                                <input
                                    type="text"
                                    class="form-control @error('slug') is-invalid @enderror"
                                    id="slug"
                                    name="slug"
                                    value="{{ old('slug') }}"
                                    placeholder="Enter Slug"
                                />
                                @error('slug')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="card-action">
                        <button type="submit" class="btn btn-success">Add Product</button>
                        <button type="reset" class="btn btn-danger">Cancel</button>
                    </div>
                </form>
                <!-- Form Ends Here -->
            </div>
        </div>
    </div>
</div>
@endsection