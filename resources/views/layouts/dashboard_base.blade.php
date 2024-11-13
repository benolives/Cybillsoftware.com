<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--=============== FAVICON ===============-->
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}" type="image/x-icon">

    <!--=============== BOXICONS ===============-->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!--=============== CSS ===============-->
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app-CmYmiJCz.css')}}">

    <title>Cybill Software | Revollutionary Repackaged | Buy Antivirus Software Online</title>

    @stack('styles')
    @php
        use Illuminate\Support\Facades\Request;
    @endphp
</head>
<body>

    <!--==================== HEADER SECTION ====================-->
    @yield('header')

    <!--==================== MAIN ====================-->
    <main class="main relative">
        <!--==================== HOME ====================-->
        @yield('content')

        <!--==================== FOOTER SECTION ====================-->
    </main>
    <!--=============== MAIN JS ===============-->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
    <script src="/build/assets/app-2m5-0K_5.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.5.1/dist/confetti.browser.min.js"></script>
    @stack('scripts')   
</body>
</html>
