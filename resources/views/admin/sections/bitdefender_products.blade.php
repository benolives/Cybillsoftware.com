@extends('layouts.admin_layout')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">Cybill Software Bitdefender products</h4>
                <a href="{{ route('admin.getBitdefenderFormPage') }}" class="btn btn-primary">
                    Add new product
                </a>
            </div>
            <div class="card-body">
                <!-- Dropdown for filtering status -->
                <div class="mb-3">
                    <label for="productFilter" class="form-label">Filter by Product:</label>
                    <select id="productFilter" class="form-select custom-select">
                    </select>
                </div>
                <!-- Table for payments -->
                <div class="table-responsive">
                    <table id="bitdefenderProductsTable" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>product name</th>
                                <th>product plan</th>
                                <th>price</th>
                                <th>stock status</th>
                                <th>commission percentage</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>product name</th>
                                <th>product plan</th>
                                <th>price</th>
                                <th>stock status</th>
                                <th>commission percentage</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->product_name }}</td>
                                <td>{{ $product->product_plan_name }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->stock_status }}</td>
                                <td>{{ $product->commission_percentage }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Initialize DataTable and store it in a variable
            var table = $('#bitdefenderProductsTable').DataTable();

            // Event listener for the product filter dropdown
            $('#productFilter').on('change', function() {
                var selectedProduct = $(this).val();

                // Apply the filter on the Product column (index 3, assuming it's the product column)
                if (selectedProduct) {
                    table.column(3).search(selectedProduct, true, false).draw();
                } else {
                    table.column(3).search('').draw();
                }
            });
        });
    </script>
@endpush