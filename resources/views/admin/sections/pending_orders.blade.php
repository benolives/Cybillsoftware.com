@extends('layouts.admin_layout')

@section('content')
<!-- ALL PENDING TABLE -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Cybill Software Pending Orders</h4>
            </div>
            <div class="card-body">
                <!-- Dropdown for filtering orders -->
                <div class="mb-3">
                    <label for="productFilter" class="form-label">Filter by</label>
                    <select id="productFilter" name="filter" class="form-select custom-select" onchange="this.form.submit()">
                        <option value="">Orders</option>
                        <!-- You can add filtering options here -->
                    </select>
                </div>

                <!-- Table for displaying completed orders -->
                <div class="table-responsive">
                    <table id="CompletedOrdersTable" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Client Email</th>
                                <th>Client Phone Number</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Transaction Date</th>
                                <th>Mpesa Receipt No</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Product Name</th>
                                <th>Client Email</th>
                                <th>Client Phone Number</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Transaction Date</th>
                                <th>Mpesa Receipt No</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->product->product_name ?? 'N/A' }}</td>
                                <td>{{ $order->email }}</td>
                                <td>{{ $order->phone_number }}</td>
                                <td>{{ number_format($order->amount, 2) }}</td>
                                <td>{{ ucfirst($order->status) }}</td>
                                <td>{{ $order->created_at->format('d-m-Y H:i') }}</td>
                                <td>{{ $order->mpesa_receipt_number }}</td>
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
        // Initialize DataTable
        var table = $('#CompletedOrdersTable').DataTable();
    });
</script>
@endpush