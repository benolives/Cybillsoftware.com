<!-- Header for Admin Dashboard -->
<div class="header">
    <div class="logo">
        <h1>Admin Dashboard</h1>
    </div>
    <div class="user-info">
        <span>Welcome, {{ Auth::user()->name }}</span>
        <a href="{{ route('logout') }}" class="logout-btn">Logout</a>
    </div>
</div>