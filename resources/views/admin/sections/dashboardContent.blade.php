@extends('layouts.admin_layout')

@section('content')
<!-- KPIs section -->
<div>
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
                                <h4 class="card-title">{{ $totalPartners }}</h4>
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
                                <h4 class="card-title">{{ $totalCustomers }}</h4>
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
                            <h4 class="card-title">{{ $totalRevenue }}</h4>
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
                            <h4 class="card-title">{{ $totalCommissions }}</h4>
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
                                <h4 class="card-title">{{ $totalProducts }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Total product keys -->
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
                                <p class="card-category">Product keys</p>
                                <h4 class="card-title">{{ $totalProductKeys }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Instock prouducts -->
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
                            <p class="card-category">Products Instock</p>
                            <h4 class="card-title">{{ $inStockProducts }}</h4>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <!-- Out of stock products -->
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
                            <h4 class="card-title">{{ $outOfStockProducts }}</h4>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- Kaspersky total products -->
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
                            <h4 class="card-title">{{ $totalkasperskyProducts }}</h4>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <!-- Bitdefender total products -->
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
                                <h4 class="card-title">{{ $totalbitdefenderProducts }}</h4>
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
                                <h4 class="card-title">0</h4>
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
                                <h4 class="card-title">0</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection