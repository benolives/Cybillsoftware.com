<div class="page-inner">
    <!-- Administator details section -->
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Admin Dashboard</h3>
            <h6 class="op-7 mb-2 font-semibold">Welcome {{ Auth::user()->name }}</h6>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="btn bg-[#fc4b3b] btn-round me-2 text-white">Logout</button>
            </form>
            <a href="javascript:void(0);" class="btn btn-primary btn-round section-item" data-section="new_partner_form">Add New Partner</a>
        </div>
    </div>
    <!-- Navigations section -->
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <button type="button" class="btn btn-info" id="alert_demo_3_4">Info</button>
        <button type="button" class="btn btn-success" id="alert_demo_3_3">Success</button>
        <button type="button" class="btn btn-primary" id="alert_demo_6">Show me</button>
    </div>
    <!-- KPIs section -->
    <h3 class="fw-bold mb-3">Key Performance Indicators</h3>
    <div class="row">
        <!-- Total partners card -->
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-primary card-round">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                        <div class="col-7 col-stats">
                            <div class="numbers">
                                <p class="card-category">Partners</p>
                                <h4 class="card-title">40</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Total Customers card -->
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-info card-round">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="fas fa-user-check"></i>
                            </div>
                        </div>
                        <div class="col-7 col-stats">
                            <div class="numbers">
                                <p class="card-category">Customers</p>
                                <h4 class="card-title">1303</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Total revenue generated -->
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-success card-round">
                <div class="card-body">
                <div class="row">
                    <div class="col-5">
                        <div class="icon-big text-center">
                            <i class="fas fa-chart-pie"></i>
                        </div>
                    </div>
                    <div class="col-7 col-stats">
                        <div class="numbers">
                            <p class="card-category">Revenue</p>
                            <h4 class="card-title">1000000</h4>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <!-- Total commissions Accumulated -->
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-secondary card-round">
                <div class="card-body">
                <div class="row">
                    <div class="col-5">
                        <div class="icon-big text-center">
                            <i class="far fa-check-circle"></i>
                        </div>
                    </div>
                    <div class="col-7 col-stats">
                        <div class="numbers">
                            <p class="card-category">Commissions</p>
                            <h4 class="card-title">100000</h4>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-card-no-pd">
        <!-- Total products -->
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="fa-solid fa-box"></i>
                            </div>
                        </div>
                        <div class="col-7 col-stats">
                            <div class="numbers">
                                <p class="card-category">Products</p>
                                <h4 class="card-title">200</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Active licences/product keys -->
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="fa-solid fa-key"></i>
                            </div>
                        </div>
                        <div class="col-7 col-stats">
                            <div class="numbers">
                                <p class="card-category">Active Licenses</p>
                                <h4 class="card-title">150</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Expired licenses/product keys -->
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                <div class="row">
                    <div class="col-5">
                        <div class="icon-big text-center">
                            <i class="fa-solid fa-key"></i>
                        </div>
                    </div>
                    <div class="col-7 col-stats">
                        <div class="numbers">
                            <p class="card-category">Expired Licenses</p>
                            <h4 class="card-title">50</h4>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <!-- Products out of stock -->
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                <div class="row">
                    <div class="col-5">
                        <div class="icon-big text-center">
                            <i class="fa-solid fa-box"></i>
                        </div>
                    </div>
                    <div class="col-7 col-stats">
                        <div class="numbers">
                            <p class="card-category">Products out of stock</p>
                            <h4 class="card-title">50</h4>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- Kaspersky products -->
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-icon">
                        <img src="{{ asset('assets/img/kaspersky_logo.png')}}" alt="kaspersky">
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                            <p class="card-category">Kaspersky</p>
                            <h4 class="card-title">100</h4>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <!-- Bitdefender products -->
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <img src="{{ asset('assets/img/bitdefender_logo.jpg')}}" alt="bitdefender">
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Bitdefender</p>
                                <h4 class="card-title">100</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- kaspersky customers -->
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-success bubble-shadow-small">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Kaspersky Clients</p>
                                <h4 class="card-title">3000</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Bitdefender customers -->
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Bitdefender clients</p>
                                <h4 class="card-title">576</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--- User/Partner managment section ----->
    <div class="row mt-4">
        <div class="col-xl-3 col-md-6">
            <!-- Active Users / Partners Widget -->
            <div class="card card-stats">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="card-title">Active Users</h5>
                            <h2 class="fw-bold mb-0">120</h2>
                        </div>
                        <div class="icon icon-info">
                            <i class="fa fa-users"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <!-- Inactive Users / Partners Widget -->
            <div class="card card-stats">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="card-title">Inactive Users</h5>
                            <h2 class="fw-bold mb-0">30</h2>
                        </div>
                        <div class="icon icon-warning">
                            <i class="fa fa-user-slash"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <!-- Role Management Widget -->
            <div class="card card-stats">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="card-title">Role Management</h5>
                            <h2 class="fw-bold mb-0">Admin, Partner</h2>
                        </div>
                        <div class="icon icon-primary">
                            <i class="fa fa-cogs"></i>
                        </div>
                    </div>
                    <button class="btn btn-primary btn-round mt-3" data-bs-toggle="modal" data-bs-target="#assignRoleModal">Assign Roles</button>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <!-- Add New Partner Button -->
            <div class="card card-stats">
                <div class="card-body text-center">
                    <h5 class="card-title">Add New Partner</h5>
                    <a href="javascript:void(0);" class="btn btn-success btn-round mt-3" data-section="new_partner_form">Add Partner</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Assign Admin Privileges Widget -->
    <div class="row mt-4">
        <div class="col-xl-6 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Assign Admin Privileges</h5>
                </div>
                <div class="card-body">
                    <form action="#" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="userSelect" class="form-label">Select User</label>
                            <select id="userSelect" name="user_id" class="form-control">
                                <option value="">-- Select User --</option>
                                <option value="1">User A</option>
                                <option value="2">User B</option>
                                <!-- Add users dynamically here -->
                            </select>
                        </div>
                        <button type="submit" class="btn btn-danger btn-round">Assign Admin</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Role Management -->
    <div class="modal fade" id="assignRoleModal" tabindex="-1" aria-labelledby="assignRoleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="assignRoleModalLabel">Assign User Role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="userSelectRole" class="form-label">Select User</label>
                            <select id="userSelectRole" name="user_id" class="form-control">
                                <option value="">-- Select User --</option>
                                <!-- Add users dynamically here -->
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="roleSelect" class="form-label">Select Role</label>
                            <select id="roleSelect" name="role" class="form-control">
                                <option value="admin">Admin</option>
                                <option value="partner">Partner</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Assign Role</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- KPIs Section -->
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="card-title">Total Sales</h5>
                            <h2 class="fw-bold mb-0">$50,000</h2>
                        </div>
                        <div class="icon icon-primary">
                            <i class="fa fa-dollar-sign"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="card-title">Total Commissions</h5>
                            <h2 class="fw-bold mb-0">$10,000</h2>
                        </div>
                        <div class="icon icon-success">
                            <i class="fa fa-chart-line"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="card-title">Active Partners</h5>
                            <h2 class="fw-bold mb-0">120</h2>
                        </div>
                        <div class="icon icon-warning">
                            <i class="fa fa-users"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="card-title">New Partners (This Month)</h5>
                            <h2 class="fw-bold mb-0">15</h2>
                        </div>
                        <div class="icon icon-info">
                            <i class="fa fa-user-plus"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Revenue & Payments Section -->
    <div class="row mt-4">   
        <div class="col-xl-6 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Revenue & Payments Insights</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <div>
                            <h6 class="card-subtitle">Total Revenue</h6>
                            <h3 class="fw-bold mb-0">$150,000</h3>
                        </div>
                        <div class="icon icon-primary">
                            <i class="fa fa-dollar-sign"></i>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <div>
                            <h6 class="card-subtitle">Payments to Partners</h6>
                            <h3 class="fw-bold mb-0">$40,000</h3>
                        </div>
                        <div class="icon icon-success">
                            <i class="fa fa-credit-card"></i>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <div>
                            <h6 class="card-subtitle">Pending Payments</h6>
                            <h3 class="fw-bold mb-0">$5,000</h3>
                        </div>
                        <div class="icon icon-warning">
                            <i class="fa fa-exclamation-circle"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Payment Insights Table -->
        <div class="col-xl-6 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Payments Overview</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Partner</th>
                                <th>Total Payments</th>
                                <th>Due Payment</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Partner A</td>
                                <td>$15,000</td>
                                <td>$2,000</td>
                                <td><span class="badge bg-success">Paid</span></td>
                            </tr>
                            <tr>
                                <td>Partner B</td>
                                <td>$25,000</td>
                                <td>$3,000</td>
                                <td><span class="badge bg-warning">Pending</span></td>
                            </tr>
                            <tr>
                                <td>Partner C</td>
                                <td>$10,000</td>
                                <td>$0</td>
                                <td><span class="badge bg-success">Paid</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
    <!-- Recent Activity Section -->
    <div class="col-xl-6 col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Recent Activity</h5>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Partner A made a sale</span>
                        <span class="text-muted">2 hours ago</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>New partner (Partner D) registered</span>
                        <span class="text-muted">1 day ago</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Commission payment to Partner B completed</span>
                        <span class="text-muted">3 days ago</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Customer purchase of Kaspersky Anti-Virus</span>
                        <span class="text-muted">5 days ago</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Alerts Section -->
    <div class="col-xl-6 col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Alerts</h5>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between">
                        <span>License for Partner A is about to expire</span>
                        <span class="badge bg-warning">Pending</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Pending commission payment</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row mt-4">
    <!-- Total Products Widget -->
    <div class="col-xl-3 col-md-6">
        <div class="card card-stats">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5 class="card-title">Total Products</h5>
                        <h2 class="fw-bold mb-0">200</h2>
                    </div>
                    <div class="icon icon-primary">
                        <i class="fa fa-cube"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Active Licenses Widget -->
    <div class="col-xl-3 col-md-6">
        <div class="card card-stats">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5 class="card-title">Active Licenses</h5>
                        <h2 class="fw-bold mb-0">150</h2>
                    </div>
                    <div class="icon icon-success">
                        <i class="fa fa-check-circle"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Expired Licenses Widget -->
    <div class="col-xl-3 col-md-6">
        <div class="card card-stats">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5 class="card-title">Expired Licenses</h5>
                        <h2 class="fw-bold mb-0">30</h2>
                    </div>
                    <div class="icon icon-warning">
                        <i class="fa fa-exclamation-circle"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending License Renewals Widget -->
    <div class="col-xl-3 col-md-6">
        <div class="card card-stats">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5 class="card-title">Pending Renewals</h5>
                        <h2 class="fw-bold mb-0">50</h2>
                    </div>
                    <div class="icon icon-info">
                        <i class="fa fa-clock"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Financial Overview Section -->
    <div class="row mt-4">
        <!-- Total Revenue from Product Sales Widget -->
        <div class="col-xl-4 col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Total Revenue from Product Sales</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <div>
                            <h3 class="fw-bold mb-0">$250,000</h3>
                            <p class="mb-0">Total Revenue</p>
                        </div>
                        <div class="icon icon-primary">
                            <i class="fa fa-dollar-sign"></i>
                        </div>
                    </div>
                    <div id="productSalesChart" style="height: 200px;"></div> <!-- Placeholder for chart -->
                    <!-- You can use a JS chart library (like Chart.js or ApexCharts) to populate this -->
                </div>
            </div>
        </div>

        <!-- Commission Breakdown Widget -->
        <div class="col-xl-4 col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Commission Breakdown</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Partner</th>
                                <th>Product</th>
                                <th>Commission</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Partner A</td>
                                <td>Product 1</td>
                                <td>$5,000</td>
                            </tr>
                            <tr>
                                <td>Partner B</td>
                                <td>Product 2</td>
                                <td>$3,500</td>
                            </tr>
                            <tr>
                                <td>Partner C</td>
                                <td>Product 3</td>
                                <td>$4,200</td>
                            </tr>
                            <!-- Add more rows dynamically -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Invoice Summary Widget -->
        <div class="col-xl-4 col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Invoice Summary</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <div>
                            <h3 class="fw-bold mb-0">$15,000</h3>
                            <p class="mb-0">Unpaid Invoices</p>
                        </div>
                        <div class="icon icon-warning">
                            <i class="fa fa-exclamation-circle"></i>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <div>
                            <h3 class="fw-bold mb-0">$45,000</h3>
                            <p class="mb-0">Completed Invoices</p>
                        </div>
                        <div class="icon icon-success">
                            <i class="fa fa-check-circle"></i>
                        </div>
                    </div>
                    <!-- You can add a link to view full invoice details -->
                    <a href="javascript:void(0);" class="btn btn-link">View All Invoices</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Graphical Visualization Section -->
    <div class="row mt-4">
        <!-- Sales Performance Graph -->
        <div class="col-xl-4 col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Sales Performance (Monthly)</h5>
                </div>
                <div class="card-body">
                    <div id="salesPerformanceGraph" style="height: 300px;"></div> <!-- Placeholder for line/bar chart -->
                    <!-- You can use Chart.js, ApexCharts, or another JS library to populate this chart dynamically -->
                </div>
            </div>
        </div>

        <!-- Sales Breakdown Pie Chart -->
        <div class="col-xl-4 col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Sales Breakdown by Product</h5>
                </div>
                <div class="card-body">
                    <div id="salesBreakdownChart" style="height: 300px;"></div> <!-- Placeholder for pie chart -->
                    <!-- Use a chart library to populate the chart with sales data -->
                </div>
            </div>
        </div>

        <!-- Commission Distribution Pie Chart -->
        <div class="col-xl-4 col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Commission Distribution</h5>
                </div>
                <div class="card-body">
                    <div id="commissionDistributionChart" style="height: 300px;"></div> <!-- Placeholder for pie chart -->
                    <!-- Use a chart library to populate this chart with commission distribution data -->
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <!-- User Growth Chart -->
        <div class="col-xl-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">User Growth Over Time</h5>
                </div>
                <div class="card-body">
                    <div id="userGrowthChart" style="height: 350px;"></div> <!-- Placeholder for line chart -->
                    <!-- Use a chart library to populate this chart with user growth data -->
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Filtering Section -->
    <div class="row mt-4">
        <!-- Search Bar -->
        <div class="col-md-6 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Search</h5>
                    <input type="text" class="form-control" id="searchInput" placeholder="Search partners, customers, sales data..." aria-label="Search">
                </div>
            </div>
        </div>

        <!-- Date Filter -->
        <div class="col-md-6 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Date Filter</h5>
                    <div class="d-flex justify-content-between">
                        <select class="form-select" id="dateRangeSelect">
                            <option value="today">Today</option>
                            <option value="last7days">Last 7 Days</option>
                            <option value="last30days">Last 30 Days</option>
                            <option value="thismonth">This Month</option>
                            <option value="custom">Custom Date Range</option>
                        </select>
                        <button class="btn btn-primary" id="applyFilterBtn">Apply</button>
                    </div>
                    <!-- Custom Date Range -->
                    <div id="customDateRange" class="mt-3" style="display: none;">
                        <input type="date" id="startDate" class="form-control mb-2" placeholder="Start Date">
                        <input type="date" id="endDate" class="form-control" placeholder="End Date">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Example data for the Sales Performance Chart (monthly sales data)
        var ctx = document.getElementById('salesPerformanceGraph').getContext('2d');
        var salesPerformanceChart = new Chart(ctx, {
            type: 'line', // Or 'bar' for a bar chart
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June'], // Months
                datasets: [{
                    label: 'Kaspersky Sales',
                    data: [12000, 19000, 15000, 25000, 22000, 30000], // Sales data
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 2,
                    fill: false
                }, {
                    label: 'Bitdefender Sales',
                    data: [8000, 13000, 12000, 20000, 19000, 25000], // Sales data
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2,
                    fill: false
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

</div>
