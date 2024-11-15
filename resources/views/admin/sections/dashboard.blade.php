@extends('admin.layout')

@section('content')
    <!-- Dashboard Content Here -->
    <div class="widgets">
        <!-- Quick Stats Widget -->
        <div class="widget quick-stats">
            <h3>Quick Stats</h3>
            <div class="stat-item">
                <h4>Clients</h4>
                <p>120</p>
            </div>
            <div class="stat-item">
                <h4>Orders</h4>
                <p>350</p>
            </div>
            <div class="stat-item">
                <h4>Sales</h4>
                <p>$50,000</p>
            </div>
            <div class="stat-item">
                <h4>Profits</h4>
                <p>$12,000</p>
            </div>
        </div>

        <!-- Recent Orders Widget -->
        <div class="widget recent-orders">
            <h3>Recent Orders</h3>
            <ul>
                <li>Order #112 - Client: John Doe - Status: Completed</li>
                <li>Order #113 - Client: Jane Smith - Status: Pending</li>
                <li>Order #114 - Client: Bob Johnson - Status: Completed</li>
                <li>Order #115 - Client: Mary Lee - Status: Shipped</li>
            </ul>
        </div>

        <!-- User Profile Widget -->
        <div class="widget user-profile">
            <h3>User Profile</h3>
            <div class="profile-info">
                <img src="https://via.placeholder.com/50" alt="Profile">
                <div>
                    <h4>Admin</h4>
                    <p>Administrator</p>
                </div>
            </div>
        </div>
    </div>
@endsection
