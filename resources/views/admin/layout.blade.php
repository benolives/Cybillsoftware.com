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
                                <a data-bs-toggle="collapse" href="#base">
                                    <i class="fa-solid fa-users"></i>
                                    <p>Clients</p>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse" id="base">
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
                                <a data-bs-toggle="collapse" href="#sidebarLayouts">
                                    <i class="fa-regular fa-handshake"></i>
                                    <p>Partners</p>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse" id="sidebarLayouts">
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
                                <a data-bs-toggle="collapse" href="#forms">
                                    <i class="fa-solid fa-box"></i>
                                    <p>Orders</p>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse" id="forms">
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
                                <a data-bs-toggle="collapse" href="javascript:void(0);">
                                    <i class="fa-solid fa-shield-halved"></i>
                                    <p>Products</p>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse" id="charts">
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
                                <a data-bs-toggle="collapse" href="javascript:void(0);">
                                    <i class="fa-solid fa-key"></i>
                                    <p>Product keys</p>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse" id="maps">
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
                                <a data-bs-toggle="collapse" href="javascript:void(0);">
                                    <i class="fa-solid fa-money-check"></i>
                                    <p>Sales</p>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse" id="maps">
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
                    @yield('content');
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

        <!-- personal dashboard javascript file for styling -->
        <script src="{{ asset('assets/js/dashboard_js/dashboard.js') }}"></script>
    </body>
</html>
