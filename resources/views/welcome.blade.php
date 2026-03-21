<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CLFMS - Computer Laboratory Facilities Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #0ea5e9;
            --primary-dark: #0284c7;
            --secondary: #10b981;
            --text-dark: #1e293b;
            --light-bg: #f8fafc;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--light-bg);
        }

        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            padding: 15px 0;
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .nav-link {
            color: var(--text-dark) !important;
            font-weight: 500;
            padding: 8px 20px !important;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            color: var(--primary) !important;
            transform: translateY(-2px);
        }

        .hero {
            background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 50%, var(--secondary) 100%);
            min-height: 90vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,%3Csvg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\" fill-rule=\"evenodd\"%3E%3Cg fill=\"%23ffffff\" fill-opacity=\"0.1\"%3E%3Cpath d=\"M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');
        }

        .hero h1 {
            font-size: 3.5rem;
            font-weight: 800;
            color: white;
            margin-bottom: 20px;
        }

        .hero p {
            font-size: 1.25rem;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 30px;
        }

        .btn-main {
            background-color: white;
            color: var(--primary);
            padding: 15px 40px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-main:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            color: var(--primary-dark);
        }

        .btn-outline-light {
            padding: 15px 40px;
            border-radius: 50px;
            font-weight: 600;
        }

        .info-section {
            padding: 80px 0;
            background: white;
        }

        .info-card {
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            padding: 40px;
            transition: all 0.3s ease;
            height: 100%;
        }

        .info-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.12);
        }

        .info-card i {
            font-size: 3rem;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 20px;
        }

        .info-card h5 {
            color: var(--text-dark);
            font-weight: 700;
            margin-bottom: 15px;
        }

        .info-card p {
            color: #64748b;
            line-height: 1.6;
        }

        footer {
            background: var(--text-dark);
            color: white;
            padding: 30px 0;
            text-align: center;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('welcome') }}">
            <i class="fas fa-laptop-code me-2"></i>CLFMS
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav align-items-center">
                <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#">About</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Features</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
                <li class="nav-item ms-3">
                    <a href="{{ route('login') }}" class="btn btn-outline-primary">Login</a>
                </li>
                <li class="nav-item ms-2">
                    <a href="{{ route('register') }}" class="btn btn-primary">Sign Up</a>
                </li>
            </ul>
        </div>
</nav>

<!-- Hero Section -->
<section class="hero">
    <div class="container text-center position-relative">
        <h1 class="animate__animated animate__fadeInDown">Welcome to CLFMS</h1>
        <p class="animate__animated animate__fadeInUp">Computer Laboratory Facilities Management System</p>
        <div class="animate__animated animate__zoomIn">
            <a href="{{ route('login') }}" class="btn btn-main me-3">Get Started</a>
            <a href="{{ route('register') }}" class="btn btn-outline-light">Create Account</a>
        </div>
</section>

<!-- Info Section -->
<section class="info-section">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col-12">
                <h2 class="fw-bold">Manage Your Lab Resources Efficiently</h2>
                <p class="text-muted">Everything you need to manage laboratory facilities in one place</p>
            </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="info-card">
                    <i class="fas fa-calendar-check"></i>
                    <h5>Easy Reservations</h5>
                    <p>Book laboratory rooms and equipment with just a few clicks. View availability in real-time.</p>
                </div>
            <div class="col-md-4">
                <div class="info-card">
                    <i class="fas fa-laptop"></i>
                    <h5>Equipment Borrowing</h5>
                    <p>Track and manage all equipment borrowings. Never miss a return date again.</p>
                </div>
            <div class="col-md-4">
                <div class="info-card">
                    <i class="fas fa-chart-line"></i>
                    <h5>Detailed Reports</h5>
                    <p>Generate comprehensive reports on usage, inventory, and transactions.</p>
                </div>
        </div>
</section>

<!-- Footer -->
<footer>
    <div class="container">
        <p class="mb-0">&copy; {{ date('Y') }} CLFMS | Computer Laboratory Facilities Management System</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
