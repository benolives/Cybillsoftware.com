@extends('layouts.admin_layout')

@section('content')
<!-- ALL CLIENTS TABLE -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Cybill Software Clients</h4>
            </div>
            <div class="card-body">
                <!-- Dropdown for filtering status -->
                <div class="mb-3">
                    <label for="productFilter" class="form-label">Filter by Product:</label>
                    <select id="productFilter" class="form-select custom-select">
                        <option value="">All Products</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->product_name }}">{{ $product->product_name }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- Table for payments -->
                <div class="table-responsive">
                    <table id="AllClientsTable" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone No</th>
                                <th>Product</th>
                                <th>Status</th>
                                <th>Subscription</th>
                                <th>Expiration</th>
                                <th>Town</th>
                                <th>Address</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>name</th>
                                <th>email</th>
                                <th>phone no</th>
                                <th>product</th>
                                <th>status</th>
                                <th>subscription</th>
                                <th>expiration</th>
                                <th>town</th>
                                <th>address</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($allClients as $client)
                            <tr>
                                <td>{{ $client->name }}</td>
                                <td>{{ $client->email }}</td>
                                <td>{{ $client->phone }}</td>
                                <td>{{ $client->product_name }}</td>
                                <td>{{ $client->status }}</td>
                                <td>{{ $client->subscription_type }}</td>
                                <td>{{ $client->expires_at }}</td>
                                <td>{{ $client->town }}</td>
                                <td>{{ $client->address }}</td>
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
            var table = $('#AllClientsTable').DataTable();

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