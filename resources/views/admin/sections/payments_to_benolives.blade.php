@extends('layouts.admin_layout')

@section('content')
<!-- PAYMENTS TO BENOLIVES TABLE -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Payments to Ben Olives</h4>
            </div>
            <div class="card-body">
                <!-- Dropdown for filtering status -->
                <div class="mb-3">
                    <label for="statusFilter">Filter by Status:</label>
                    <select id="statusFilter" class="form-control">
                        <option value="">All</option>
                        <option value="success">Success</option>
                        <option value="pending">Pending</option>
                        <option value="fail">Fail</option>
                    </select>
                </div>

                <!-- Table for payments -->
                <div class="table-responsive">
                    <table id="benOlivesTable" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Transaction ID</th>
                                <th>Amount</th>
                                <th>Beneficiary</th>
                                <th>Cost</th>
                                <th>Status</th>
                                <th>Time</th>
                                <th>Reference No</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Transaction ID</th>
                                <th>Amount</th>
                                <th>Beneficiary</th>
                                <th>Cost</th>
                                <th>Status</th>
                                <th>Time</th>
                                <th>Reference No</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($paymentsToBenOlives as $payment)
                            <tr>
                                <td>{{ $payment->transaction_id }}</td>
                                <td>{{ $payment->amount }} {{ $payment->currency_code }}</td>
                                <td>{{ $payment->beneficiary_name }}</td>
                                <td>{{ $payment->charges ?? 'N/A' }}</td>
                                <td>{{ ucfirst($payment->transaction_status) }}</td>
                                <td>{{ \Carbon\Carbon::parse($payment->transaction_completed_time)->format('Y-m-d H:i:s') }}</td>
                                <td>{{ $payment->transaction_reference_number }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Cards or Buttons for Account Balance and Total Transaction Cost -->
                <div class="row mt-4">
                    <!-- Account Balance Card -->
                    <div class="col-md-6">
                        <div class="card bg-success text-white">
                            <div class="card-header">
                                <h5>Account Balance</h5>
                            </div>
                            <div class="card-body">
                                <p class="lead">KES 500,000.00</p>
                            </div>
                        </div>
                    </div>

                    <!-- Total Transaction Cost Card -->
                    <div class="col-md-6">
                        <div class="card bg-warning text-dark">
                            <div class="card-header">
                                <h5>Total Transaction Cost</h5>
                            </div>
                            <div class="card-body">
                                <p class="lead">KES 15,000.00</p> <!-- Replace with dynamic data -->
                            </div>
                        </div>
                    </div>
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
        var table = $('#benOlivesTable').DataTable();

        // Event listener for the status filter dropdown
        $('#statusFilter').on('change', function() {
            var selectedStatus = $(this).val();

            // Apply the filter on the Status column (index 4)
            if (selectedStatus) {
                table.column(4).search(selectedStatus, true, false).draw();
            } else {
                table.column(4).search('').draw();
            }
        });
    });
</script>
@endpush