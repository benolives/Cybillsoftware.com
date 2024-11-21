<div class="page-inner" id="benolives_payments_section">
    <!-- Header Section -->
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Ben Olives Payments</h3>
            <h6 class="op-7 mb-2 font-semibold">Welcome {{ Auth::user()->name }}</h6>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="btn bg-[#fc4b3b] btn-round me-2 text-white">Logout</button>
            </form>
        </div>
    </div>


    <!-- Starter Section to Show BenOlives Payment Details -->
    <h3 class="fw-bold mb-3">Kaspersky Products Sales & Commissions</h3>
    <div class="row row-card-no-pd mt--2">
        <!-- Today's Income Card -->
        <div class="col-12 col-sm-6 col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5><b>Today's Income</b></h5>
                            <p class="text-muted">All Custom Values</p>
                        </div>
                        <!-- Dynamically show today's income -->
                        <h3 class="text-info fw-bold">{{ number_format($todayIncome, 2) }} KSh</h3>
                    </div>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-info" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <p class="text-muted mb-0">Change</p>
                        <p class="text-muted mb-0">75%</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Revenue Card -->
        <div class="col-12 col-sm-6 col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5><b>Total Revenue</b></h5>
                            <p class="text-muted">All Custom Values</p>
                        </div>
                        <!-- Dynamically show total revenue -->
                        <h3 class="text-success fw-bold">{{ number_format($totalRevenue, 2) }} KSh</h3>
                    </div>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <p class="text-muted mb-0">Change</p>
                        <p class="text-muted mb-0">25%</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- New Orders Card -->
        <div class="col-12 col-sm-6 col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5><b>New Orders</b></h5>
                            <p class="text-muted">Fresh Order Amount</p>
                        </div>
                        <!-- Dynamically show the number of new orders -->
                        <h3 class="text-danger fw-bold">{{ $newOrders }}</h3>
                    </div>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <p class="text-muted mb-0">Change</p>
                        <p class="text-muted mb-0">50%</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- New Users Card -->
        <div class="col-12 col-sm-6 col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5><b>New Users</b></h5>
                            <p class="text-muted">Joined New User</p>
                        </div>
                        <!-- Dynamically show the number of new users -->
                        <h3 class="text-secondary fw-bold">{{ $newUsers }}</h3>
                    </div>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-secondary" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <p class="text-muted mb-0">Change</p>
                        <p class="text-muted mb-0">50%</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Requests Section -->
        <div class="col-12">
            <h5 class="mt-4"><b>Payment Requests for Kaspersky</b></h5>
            <ul class="list-group">
                @foreach($paymentRequests as $payment)
                    <li class="list-group-item">
                        <strong>{{ $payment->phone }}</strong> - {{ number_format($payment->amount, 2) }} KSh - {{ $payment->status }}
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <!-- Kaspersky partners sales details -->
    <h3 class="fw-bold mb-3">Kaspersky Products Partners</h3>
    <div class="col-md-12">
        <div class="benolives_payment_section">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between flex-column flex-sm-row">
                        <!-- Search bar inside the card header -->
                        <input type="text" id="search-partner-sales" class="form-control form-control-sm mb-2 mb-sm-0" placeholder="Search..." style="max-width: 250px;" />

                        <!-- Buttons inside the card tools -->
                        <div class="card-tools d-flex flex-column flex-sm-row mt-2 mt-sm-0">
                            <a href="{{ route('export.kaspersky_partners') }}" class="btn btn-label-success btn-round btn-sm me-2 mb-2 mb-sm-0" id="export-btn">
                                <span class="btn-label">
                                    <i class="fa fa-pencil"></i>
                                </span>
                                Export
                            </a>
                            <a href="#" class="btn btn-label-info btn-round btn-sm mb-2 mb-sm-0" id="print-btn">
                                <span class="btn-label">
                                    <i class="fa fa-print"></i>
                                </span>
                                Print
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Table Wrapper for Responsiveness -->
        <div class="table-responsive">
            <table class="table table-bordered" id="partner-sales-table">
                <thead>
                    <tr>
                        <th>License Key</th>
                        <th>Product</th>
                        <th>Expiry Date</th>
                        <th>Partner</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>ABCD-1234-EFGH-5678</td>
                        <td>Kaspersky Total Security</td>
                        <td>2025-12-31</td>
                        <td>Partner A</td>
                    </tr>
                    <tr>
                        <td>EFGH-2345-IJKL-6789</td>
                        <td>Kaspersky Internet Security</td>
                        <td>2024-11-30</td>
                        <td>Partner B</td>
                    </tr>
                    <tr>
                        <td>IJKL-3456-MNOP-7890</td>
                        <td>Kaspersky Anti-Virus</td>
                        <td>2024-10-15</td>
                        <td>Partner C</td>
                    </tr>
                    <tr>
                        <td>MNOP-4567-QRST-8901</td>
                        <td>Kaspersky Endpoint Security</td>
                        <td>2026-05-20</td>
                        <td>Partner A</td>
                    </tr>
                    <tr>
                        <td>QRST-5678-UVWX-1234</td>
                        <td>Kaspersky Total Security</td>
                        <td>2024-07-25</td>
                        <td>Partner B</td>
                    </tr>
                    <tr>
                        <td>WXYZ-6789-ABCD-3456</td>
                        <td>Kaspersky Internet Security</td>
                        <td>2025-05-30</td>
                        <td>Partner C</td>
                    </tr>
                    <!-- Additional rows can go here -->
                </tbody>
            </table>
        </div>
        <div id="pagination" class="pagination-container mt-3">
            <!-- Pagination will be inserted dynamically -->
        </div>
    </div>
</div>