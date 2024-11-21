<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title>Cybill Admin | Dashboard</title>
        <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport"/>
        <link rel="icon" href="{{ asset('assets/img/favicon.png')}}" type="image/x-icon"/>

        <!-- This is a link to font awesome icons that I have downloaded locally and they are in Our
        public directory -->
        <link href="{{ asset('assets/css/fontawesome_css/all.min.css') }}" rel="stylesheet">

        <!-- CSS Files -->
        <link rel="stylesheet" href="{{ asset('assets/css/dashboard_css/bootstrap.min.css')}}" />
        <link rel="stylesheet" href="{{ asset('assets/css/dashboard_css/plugins.min.css')}}" />
        <link rel="stylesheet" href="{{ asset('assets/css/dashboard_css/kaiadmin.min.css')}}" />
        <link rel="stylesheet" href="{{ asset('assets/css/app-CmYmiJCz.css')}}">
        <link rel="stylesheet" href="{{ asset('assets/css/dashboard_css/dashboard.css')}}" />
    </head>
    <body>
        <div class="wrapper">
            <!-- Sidebar section -->
            <div class="sidebar" data-background-color="dark">
                <div class="sidebar-logo">
                    <!-- Logo Header -->
                    <div class="logo-header" data-background-color="dark">
                        <a href="{{ route('app.index') }}" class="logo">
                        <img src="{{ asset('assets/img/cybillogo.png')}}" alt="navbar brand" class="navbar-brand" height="20"/>
                        </a>
                        <div class="nav-toggle">
                        <button class="btn btn-toggle toggle-sidebar">
                            <i class="gg-menu-right"></i>
                        </button>
                        <button class="btn btn-toggle sidenav-toggler">
                            <i class="gg-menu-left"></i>
                        </button>
                        </div>
                        <button class="topbar-toggler more">
                        <i class="gg-more-vertical-alt"></i>
                        </button>
                    </div>
                    <!-- End Logo Header -->
                </div>
                <div class="sidebar-wrapper scrollbar scrollbar-inner">
                    <div class="sidebar-content">
                        <ul class="nav nav-secondary">
                            <!-- dashboard section -->
                            <li class="nav-item active dashboard section-item" data-section="dashboard">
                                <a data-bs-toggle="collapse" href="javascript:void(0);" class="collapsed" aria-expanded="false">
                                    <i class="fas fa-home"></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>
                            <!-- cybill software marker -->
                            <li class="nav-section">
                                <span class="sidebar-mini-icon">
                                <i class="fa fa-ellipsis-h"></i>
                                </span>
                                <h4 class="text-section">Cybill Software</h4>
                            </li>

                            <!-- clients section -->
                            <li class="nav-item clients">
                                <a href="javascript:void(0);" class="collapse-toggle">
                                    <i class="fa-solid fa-users"></i>
                                    <p>Clients</p>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse-content collapse" id="clients">
                                    <ul class="nav nav-collapse">
                                        <li class="section-item" data-section="all_clients">
                                            <a href="javascript:void(0);">
                                                <span class="sub-item">All clients</span>
                                            </a>
                                        </li>
                                        <li class="section-item" data-section="kaspersky_clients">
                                            <a href="javascript:void(0);">
                                                <span class="sub-item">Kaspersky clients</span>
                                            </a>
                                        </li>
                                        <li class="section-item" data-section="bitdefender_clients">
                                            <a href="javascript:void(0);">
                                                <span class="sub-item">Bitdefender clients</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <!-- partners section -->
                            <li class="nav-item partners">
                                <a href="javascript:void(0);" class="collapse-toggle">
                                    <i class="fa-regular fa-handshake"></i>
                                    <p>Partners</p>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse-content collapse" id="partners">
                                <ul class="nav nav-collapse">
                                    <li class="section-item" data-section="all_partners">
                                        <a href="partners.html">
                                            <span class="sub-item">All partners</span>
                                        </a>
                                    </li>
                                </ul>
                                </div>
                            </li>

                            <!-- orders section -->
                            <li class="nav-item orders">
                                <a href="javascript:void(0);" class="collapse-toggle">
                                    <i class="fa-solid fa-box"></i>
                                    <p>Orders</p>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse-content collapse" id="orders">
                                    <ul class="nav nav-collapse">
                                        <li class="section-item" data-section="completed_orders">
                                            <a href="javascript:void(0);">
                                                <span class="sub-item">Completed</span>
                                            </a>
                                        </li>
                                        <li class="section-item" data-section="not_completed_orders">
                                            <a href="javascript:void(0);">
                                                <span class="sub-item">Not Completed</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <!-- product management marker -->
                            <li class="nav-section product_management_section">
                                <span class="sidebar-mini-icon">
                                <i class="fa fa-ellipsis-h"></i>
                                </span>
                                <h4 class="text-section">Products Management</h4>
                            </li>
                            <!-- categories section -->
                            <li class="nav-item Categories section-item" data-section="categories">
                                <a data-bs-toggle="collapse" href="javascript:void(0);">
                                    <i class="fa-solid fa-layer-group"></i>
                                    <p>Categories</p>
                                </a>
                            </li>

                            <!-- products section -->
                            <li class="nav-item products">
                                <a href="javascript:void(0);" class="collapse-toggle">
                                    <i class="fa-solid fa-shield-halved"></i>
                                    <p>Products</p>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse-content collapse" id="products">
                                <ul class="nav nav-collapse">
                                    <li class="section-item" data-section="kaspersky_products">
                                        <a href="javascript:void(0);">
                                            <span class="sub-item">Kaspersky</span>
                                        </a>
                                    </li>
                                    <li class="section-item" data-section="bitdefender_products">
                                        <a href="javascript:void(0);">
                                            <span class="sub-item">Bitdefender</span>
                                        </a>
                                    </li>
                                </ul>
                                </div>
                            </li>

                            <!-- product keys section -->
                            <li class="nav-item product_keys">
                                <a href="javascript:void(0);" class="collapse-toggle">
                                    <i class="fa-solid fa-key"></i>
                                    <p>Product keys</p>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse-content collapse" id="product_keys">
                                    <ul class="nav nav-collapse">
                                        <li class="section-item" data-section="kaspersky_keys">
                                            <a href="javascript:void(0);">
                                                <span class="sub-item">Kaspersky keys</span>
                                            </a>
                                        </li>
                                        <li class="section-item" data-section="bitdefender_keys">
                                            <a href="javascript:void(0);">
                                                <span class="sub-item">Bitdefender Keys</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <!-- Transactions marker -->
                            <li class="nav-section transactions_section">
                                <span class="sidebar-mini-icon">
                                <i class="fa fa-ellipsis-h"></i>
                                </span>
                                <h4 class="text-section">Transactions</h4>
                            </li>
                            <!-- transaction history section -->
                            <li class="nav-item transaction_history section-item" data-section="transaction_history">
                                <a data-bs-toggle="collapse" href="javascript:void(0);">
                                    <i class="fa-solid fa-money-check"></i>
                                    <p>Transaction history</p>
                                </a>
                            </li>
                            <!-- sales section -->
                            <li class="nav-item sales">
                                <a href="javascript:void(0);" class="collapse-toggle">
                                    <i class="fa-solid fa-money-check"></i>
                                    <p>Sales</p>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse-content collapse" id="sales">
                                    <ul class="nav nav-collapse">
                                        <li class="section-item" data-section="kaspersky_sales">
                                            <a href="javascript:void(0);">
                                                <span class="sub-item">Kaspersky sales</span>
                                            </a>
                                        </li>
                                        <li class="section-item" data-section="bitdefender_sales">
                                            <a href="javascript:void(0);">
                                                <span class="sub-item">Bitdefender sales</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <!-- payments section -->
                            <li class="nav-item payments">
                                <a href="javascript:void(0);" class="collapse-toggle">
                                    <i class="fa-solid fa-money-check"></i>
                                    <p>Payments</p>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse-content collapse" id="payments">
                                <ul class="nav nav-collapse">
                                    <li class="section-item" data-section="kaspersky_payments">
                                        <a href="javascript:void(0);">
                                            <span class="sub-item">BenOlives payments</span>
                                        </a>
                                    </li>
                                    <li class="section-item" data-section="bitdefender_payments">
                                        <a href="javascript:void(0);">
                                            <span class="sub-item">Bitdefender payments</span>
                                        </a>
                                    </li>
                                </ul>
                                </div>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
            <!-- End Sidebar section-->

            <!-- Main panel section starts here -->
            <div class="main-panel">
                <!-- the header part -->
                <div class="main-header">
                    <div class="main-header-logo">
                        <!-- Logo Header -->
                        <div class="logo-header" data-background-color="dark">
                            <a href="index.html" class="logo">
                                <img
                                src="{{asset('assets/img/cybillogo.png')}}"
                                alt="navbar brand"
                                class="navbar-brand"
                                height="20"
                                />
                            </a>
                            <div class="nav-toggle">
                                <button class="btn btn-toggle toggle-sidebar">
                                    <i class="gg-menu-right"></i>
                                </button>
                                <button class="btn btn-toggle sidenav-toggler">
                                    <i class="gg-menu-left"></i>
                                </button>
                            </div>
                            <button class="topbar-toggler more">
                                <i class="gg-more-vertical-alt"></i>
                            </button>
                        </div>
                        <!-- End Logo Header -->
                    </div>
                    <!-- Navbar Header section for Mobile screen and smaller -->
                    <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
                        <div class="container-fluid">
                            <nav class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
                                <div class="input-group search_bar">
                                    <div class="input-group-prepend">
                                        <button type="submit" class="btn btn-search pe-1">
                                            <i class="fa fa-search search-icon"></i>
                                        </button>
                                    </div>
                                    <input
                                        type="text"
                                        placeholder="Search ..."
                                        class="form-control"
                                    />
                                </div>
                            </nav>
                            <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                                <li class="nav-item topbar-user dropdown hidden-caret">
                                    <a
                                        class="dropdown-toggle profile-pic"
                                        data-bs-toggle="dropdown"
                                        href="#"
                                        aria-expanded="false"
                                    >
                                        <div class="avatar-sm">
                                            <img
                                                src="{{ asset('assets/img/anime.jpg') }}"
                                                alt="..."
                                                class="avatar-img rounded-circle"
                                            />
                                        </div>
                                        <span class="profile-username">
                                            <span class="op-7">Hi,</span>
                                            <span class="fw-bold">Gitau</span>
                                        </span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-user animated fadeIn">
                                        <div class="dropdown-user-scroll scrollbar-outer">
                                            <li>
                                                <div class="user-box">
                                                    <div class="avatar-lg">
                                                        <img
                                                            src="{{ asset('assets/img/anime.jpg') }}"
                                                            alt="image profile"
                                                            class="avatar-img rounded"
                                                        />
                                                    </div>
                                                    <div class="u-text">
                                                        <h4>Gitau</h4>
                                                        <p class="text-muted">kgitau3@example.com</p>
                                                        <a href="profile.html" class="btn btn-xs btn-secondary btn-sm">
                                                            View Profile
                                                        </a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="#">My Profile</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="#">Account Setting</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="#">Logout</a>
                                            </li>
                                        </div>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </nav>
                    <!-- End Navbar -->
                </div>
                <!-- content part -->
                <div class="container" id="main-panel-content-section">
                    <div class="page-inner">
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
                </div>

                <!-- Footer section starts here -->
                <footer class="footer">
                    <div class="container-fluid d-flex justify-content-between">
                        <nav class="pull-left">
                            <ul class="nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="#"> Help </a>
                                </li>
                            </ul>
                        </nav>
                        <div class="copyright">
                            2024, made with <i class="fa fa-heart heart text-danger"></i> by
                            <a href="http://www.themekita.com">Cybill Team</a>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <!--   Core JS Files   -->
        <script src="{{ asset('assets/js/dashboard_js/jquery-3.7.1.min.js') }}"></script>
        <script src="{{ asset('assets/js/dashboard_js/popper.min.js') }}"></script>
        <script src="{{ asset('assets/js/dashboard_js/bootstrap.min.js') }}"></script>

        <!-- Kaiadmin JS -->
        <script src="{{ asset('assets/js/dashboard_js/kaiadmin.min.js') }}"></script>
        <!-- jQuery Scrollbar -->
        <script src="{{ asset('assets/js/dashboard_js/jquery.scrollbar.min.js') }}"></script>

        <!-- Datatables -->
        <script src="{{ asset('assets/js/dashboard_js/datatables.min.js') }}"></script>

        <!-- personal dashboard javascript file for styling -->
        <script src="{{ asset('assets/js/dashboard_js/dashboard.js') }}"></script>
    </body>
</html>
