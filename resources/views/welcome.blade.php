<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS System</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f7fb;
            font-family: 'Segoe UI', sans-serif;
        }

        .navbar {
            background: #1e293b;
        }

        .navbar a {
            color: #fff !important;
        }

        .hero {
            padding: 80px 0;
            text-align: center;
        }

        .hero h1 {
            font-weight: bold;
            color: #1e293b;
        }

        .card-custom {
            border: none;
            border-radius: 12px;
            transition: 0.3s;
        }

        .card-custom:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }

        .btn-main {
            background: #6366f1;
            color: white;
        }

        .btn-main:hover {
            background: #4f46e5;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand text-white" href="#">My POS</a>

        <div>
            @auth
                <a href="{{ url('/home') }}" class="btn btn-light">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="btn btn-light">Login</a>
            @endauth
        </div>
    </div>
</nav>

<!-- Hero -->
<section class="hero">
    <div class="container">
        <h1>Manage Your Business Smartly</h1>
        <p class="text-muted mt-3">
            Products • Orders • Customers • Ledger • Expenses
        </p>

        <a href="{{ route('login') }}" class="btn btn-main mt-4 px-4 py-2">
            Get Started
        </a>
    </div>
</section>

<!-- Features -->
<section class="container mb-5">
    <div class="row g-4">

        <div class="col-md-4">
            <div class="card card-custom p-4 text-center">
                <h5>Products</h5>
                <p class="text-muted">Manage inventory and stock easily</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-custom p-4 text-center">
                <h5>Orders</h5>
                <p class="text-muted">Track sales and invoices</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-custom p-4 text-center">
                <h5>Ledger</h5>
                <p class="text-muted">Maintain customer & vendor accounts</p>
            </div>
        </div>

    </div>
</section>

<!-- Footer -->
<footer class="text-center py-4 text-muted">
    © {{ date('Y') }} My POS System
</footer>

</body>
</html>
