<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CLFMS - Computer Laboratory Facilities Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #0ea5e9;
            --primary-dark: #0284c7;
            --secondary: #10b981;
            --gray-dark: #1e293b;
            --gray-medium: #475569;
            --surface: #f8fafc;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--surface);
            color: var(--gray-dark);
        }

        .navbar {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(20px);
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
            padding: 1rem 0;
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--gray-dark);
        }

        .navbar-brand i {
            color: var(--primary);
        }

        .nav-link {
            color: var(--gray-medium) !important;
            font-weight: 500;
            transition: color 0.3s ease, transform 0.3s ease;
        }

        .nav-link:hover {
            color: var(--primary) !important;
            transform: translateY(-1px);
        }

        .btn-primary {
            border-radius: 999px;
            padding: 0.95rem 1.8rem;
            font-weight: 600;
            box-shadow: 0 16px 30px rgba(14, 165, 233, 0.18);
        }

        .btn-outline-primary {
            border-radius: 999px;
            padding: 0.95rem 1.8rem;
            font-weight: 600;
        }

        .hero {
            min-height: 92vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
            padding: 120px 0 80px;
            background: radial-gradient(circle at top, rgba(255,255,255,0.18), transparent 40%), linear-gradient(135deg, #0f172a 0%, #0ea5e9 45%, #22c55e 100%);
            color: white;
        }

        .hero::after {
            content: '';
            position: absolute;
            inset: 0;
            background: url('data:image/svg+xml,%3Csvg width="80" height="80" viewBox="0 0 80 80" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd" stroke="%23ffffff" stroke-opacity="0.08" stroke-width="1"%3E%3Cpath d="M40 0v80M0 40h80"/%3E%3C/g%3E%3C/svg%3E') center/320px 320px no-repeat;
            opacity: 0.25;
            pointer-events: none;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero h1 {
            font-size: clamp(2.8rem, 5vw, 4.5rem);
            font-weight: 800;
            line-height: 1.05;
            margin-bottom: 1.25rem;
            max-width: 820px;
        }

        .hero p {
            font-size: 1.15rem;
            color: rgba(255, 255, 255, 0.92);
            margin-bottom: 2rem;
            max-width: 680px;
            line-height: 1.7;
        }

        .hero-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            justify-content: center;
        }

        .hero-panel {
            position: relative;
            z-index: 2;
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.18);
            backdrop-filter: blur(18px);
            border-radius: 28px;
            padding: 2rem;
            box-shadow: 0 35px 80px rgba(15, 23, 42, 0.18);
        }

        .hero-panel h3 {
            color: white;
            font-weight: 700;
            margin-bottom: 0.75rem;
        }

        .hero-panel p {
            color: rgba(255, 255, 255, 0.82);
        }

        .feature-section {
            padding: 80px 0;
        }

        .section-title {
            text-align: center;
            margin-bottom: 3rem;
        }

        .section-title h2 {
            font-size: clamp(2rem, 3vw, 3rem);
            font-weight: 800;
            margin-bottom: 0.75rem;
            background: linear-gradient(135deg, #0ea5e9 0%, #10b981 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .section-title p {
            max-width: 620px;
            margin: 0 auto;
            color: #64748b;
            line-height: 1.8;
        }

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 1.5rem;
        }

        .feature-card {
            background: white;
            border-radius: 24px;
            padding: 2rem;
            box-shadow: 0 18px 50px rgba(15, 23, 42, 0.08);
            transition: transform 0.35s ease, box-shadow 0.35s ease;
        }

        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 26px 70px rgba(15, 23, 42, 0.12);
        }

        .feature-icon {
            width: 64px;
            height: 64px;
            display: grid;
            place-items: center;
            margin-bottom: 1.25rem;
            border-radius: 18px;
            background: linear-gradient(135deg, rgba(14, 165, 233, 0.15), rgba(16, 185, 129, 0.15));
            color: var(--primary);
            font-size: 1.75rem;
        }

        .feature-card h5 {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 0.85rem;
        }

        .feature-card p {
            color: #64748b;
            line-height: 1.75;
        }

        .footer {
            background: #0f172a;
            color: #cbd5e1;
            padding: 2rem 0;
        }

        .footer a {
            color: #93c5fd;
            text-decoration: none;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container-lg">
        <a class="navbar-brand" href="{{ route('welcome') }}">
            <i class="fas fa-laptop-code me-2"></i>CLFMS
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav align-items-center">
                <li class="nav-item"><a class="nav-link" href="#features">Features</a></li>
                <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                <li class="nav-item ms-3">
                    <a href="{{ route('login') }}" class="btn btn-outline-primary">Login</a>
                </li>
                <li class="nav-item ms-2">
                    <a href="{{ route('register') }}" class="btn btn-primary">Sign Up</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<section class="hero" id="hero">
    <div class="container-lg">
        <div class="row align-items-center gx-5">
            <div class="col-lg-7">
                <div class="hero-content text-center text-lg-start">
                    <p class="text-uppercase fw-semibold mb-3" style="letter-spacing: 0.24em; color: rgba(255,255,255,0.85);">Modern lab resource management</p>
                    <h1 class="animate__animated animate__fadeInDown" data-aos="fade-down" data-aos-duration="700">Powerful laboratory management built for today’s institutions.</h1>
                    <p class="animate__animated animate__fadeInUp" data-aos="fade-up" data-aos-delay="150">Streamline equipment reservations, borrowing workflows, incident reporting, and analytics with a polished, easy-to-use platform.</p>
                    <div class="hero-buttons justify-content-center justify-content-lg-start">
                        <a href="{{ route('register') }}" class="btn btn-primary btn-lg">Get Started</a>
                        <a href="{{ route('login') }}" class="btn btn-outline-primary btn-lg">Login</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 mt-5 mt-lg-0">
                <div class="hero-panel" data-aos="zoom-in" data-aos-delay="250">
                    <h3>Live overview</h3>
                    <p>Monitor reservations, equipment availability, and notifications with a clean, modern dashboard snapshot.</p>
                    <div class="row g-3 mt-4">
                        <div class="col-6">
                            <div class="p-3 rounded-4" style="background: rgba(255,255,255,0.12);">
                                <strong>12</strong>
                                <p class="mb-0" style="color: rgba(255,255,255,0.8);">Labs online</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 rounded-4" style="background: rgba(255,255,255,0.12);">
                                <strong>320+</strong>
                                <p class="mb-0" style="color: rgba(255,255,255,0.8);">Equipment items</p>
                            </div>
                        </div>
                        <div class="col-12 mt-2">
                            <div class="p-3 rounded-4" style="background: rgba(255,255,255,0.12);">
                                <strong>98%</strong>
                                <p class="mb-0" style="color: rgba(255,255,255,0.8);">Reservation accuracy</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="feature-section" id="features">
    <div class="container-lg">
        <div class="section-title" data-aos="fade-up" data-aos-duration="700">
            <h2>Essential features for modern laboratories</h2>
            <p>CLFMS gives your team a polished workflow for reservations, equipment management, incident reporting, and reporting insights.</p>
        </div>
        <div class="feature-grid">
            <div class="feature-card" data-aos="fade-up" data-aos-delay="100">
                <div class="feature-icon"><i class="fas fa-calendar-check"></i></div>
                <h5>Smart reservations</h5>
                <p>Schedule lab spaces and equipment with built-in availability checks and conflict prevention.</p>
            </div>
            <div class="feature-card" data-aos="fade-up" data-aos-delay="150">
                <div class="feature-icon"><i class="fas fa-laptop"></i></div>
                <h5>Equipment inventory</h5>
                <p>Keep asset records current, track status, and see equipment history at a glance.</p>
            </div>
            <div class="feature-card" data-aos="fade-up" data-aos-delay="200">
                <div class="feature-icon"><i class="fas fa-exchange-alt"></i></div>
                <h5>Borrowing workflows</h5>
                <p>Manage checkouts, returns, and borrower records with clear due-date alerts.</p>
            </div>
            <div class="feature-card" data-aos="fade-up" data-aos-delay="250">
                <div class="feature-icon"><i class="fas fa-exclamation-triangle"></i></div>
                <h5>Incident reporting</h5>
                <p>Log issues, assign follow-ups, and keep your lab team informed with fast reporting.</p>
            </div>
            <div class="feature-card" data-aos="fade-up" data-aos-delay="300">
                <div class="feature-icon"><i class="fas fa-bell"></i></div>
                <h5>Notifications</h5>
                <p>Receive alerts for reservations, returns, and important updates automatically.</p>
            </div>
            <div class="feature-card" data-aos="fade-up" data-aos-delay="350">
                <div class="feature-icon"><i class="fas fa-chart-bar"></i></div>
                <h5>Analytics</h5>
                <p>Review usage trends and reports that help you optimize lab operations.</p>
            </div>
        </div>
    </div>
</section>

<section class="feature-section" id="about">
    <div class="container-lg">
        <div class="row align-items-center gy-4">
            <div class="col-lg-6" data-aos="fade-right" data-aos-delay="100">
                <h2>Why institutions choose CLFMS</h2>
                <p class="mb-4">A modern interface, robust features, and a responsive experience make it easier for administrators and students to use the lab system every day.</p>
                <ul class="list-unstyled">
                    <li class="mb-3"><i class="fas fa-check-circle text-primary me-2"></i>Fast reservation workflows</li>
                    <li class="mb-3"><i class="fas fa-check-circle text-primary me-2"></i>Clear equipment tracking</li>
                    <li class="mb-3"><i class="fas fa-check-circle text-primary me-2"></i>Reliable reporting and analytics</li>
                </ul>
            </div>
            <div class="col-lg-6" data-aos="fade-left" data-aos-delay="150">
                <div class="feature-card p-4" style="background: #eef7ff;">
                    <div class="feature-icon" style="color: #0ea5e9; background: rgba(14,165,233,0.12);"><i class="fas fa-rocket"></i></div>
                    <h5>Built for teams</h5>
                    <p>Designed to support lab staff, faculty, and students with fast access to everything they need in one central system.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="feature-section bg-white" id="contact">
    <div class="container-lg text-center" data-aos="fade-up" data-aos-duration="700">
        <h2>Ready to get started?</h2>
        <p class="mb-4">Create your account and start managing your laboratory facilities more efficiently today.</p>
        <a href="{{ route('register') }}" class="btn btn-primary btn-lg me-3">Sign Up Now</a>
        <a href="{{ route('login') }}" class="btn btn-outline-primary btn-lg">Login</a>
    </div>
</section>

<footer class="footer">
    <div class="container-lg text-center">
        <p class="mb-2">&copy; {{ date('Y') }} CLFMS. All rights reserved.</p>
        <p class="mb-0">Laboratory resource management built for reliable, modern workflows.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 650,
        easing: 'ease-out-cubic',
        once: true,
        mirror: false,
        offset: 120
    });
</script>
</body>
</html>
