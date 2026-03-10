<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CLFMS - Computer Laboratory Facilities Management System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { font-family: 'Inter', sans-serif; background: #f8fafc; color: #1e293b; }
    .hero { background: linear-gradient(135deg, #0ea5e9 0%, #10b981 100%); padding: 80px 0; text-align: center; }
    .hero h1 { font-size: 3rem; font-weight: 800; color: white; margin-bottom: 15px; }
    .hero p { font-size: 1.2rem; color: rgba(255,255,255,0.9); margin-bottom: 25px; }
    .btn-hero { padding: 14px 32px; border-radius: 10px; font-weight: 600; text-decoration: none; display: inline-block; margin: 5px; transition: all 0.3s; }
    .btn-hero-white { background: white; color: #0ea5e9; }
    .btn-hero-white:hover { transform: translateY(-2px); box-shadow: 0 10px 25px rgba(0,0,0,0.2); }
    .btn-hero-outline { border: 2px solid white; color: white; }
    .btn-hero-outline:hover { background: white; color: #0ea5e9; }
    .section { padding: 60px 0; }
    .section-title { text-align: center; margin-bottom: 40px; }
    .section-title h2 { font-size: 2rem; font-weight: 700; color: #1e293b; margin-bottom: 10px; }
    .section-title p { color: #64748b; font-size: 1rem; }
    .card-custom { background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.08); transition: all 0.3s; height: 100%; margin-bottom: 20px; }
    .card-custom:hover { transform: translateY(-5px); box-shadow: 0 12px 30px rgba(0,0,0,0.15); }
    .card-custom img { width: 100%; height: 180px; object-fit: cover; }
    .card-custom .card-body { padding: 20px; }
    .card-custom h5 { font-size: 1.1rem; font-weight: 600; color: #1e293b; margin-bottom: 8px; }
    .card-custom p { color: #64748b; font-size: 0.9rem; margin-bottom: 12px; }
    .badge-custom { display: inline-block; padding: 4px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: 600; }
    .badge-green { background: #d1fae5; color: #059669; }
    .badge-yellow { background: #fef3c7; color: #d97706; }
    .stats-section { background: linear-gradient(135deg, #0ea5e9 0%, #10b981 100%); padding: 50px 0; }
    .stat-box { text-align: center; color: white; }
    .stat-number { font-size: 2.5rem; font-weight: 700; }
    .stat-label { font-size: 0.9rem; opacity: 0.9; }
    .feature-icon { width: 70px; height: 70px; background: linear-gradient(135deg, #0ea5e9, #10b981); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px; }
    .feature-icon i { font-size: 28px; color: white; }
    .feature-box { text-align: center; padding: 20px; }
    .feature-box h5 { font-weight: 600; margin-bottom: 10px; }
    .feature-box p { color: #64748b; font-size: 0.9rem; }
    footer { background: #1e293b; color: white; padding: 40px 0 20px; text-align: center; }
    footer p { color: #94a3b8; font-size: 0.9rem; }
    @media (max-width: 768px) { .hero h1 { font-size: 2rem; } .btn-hero { display: block; width: auto; margin: 10px auto; } }
  </style>
</head>
<body>
<section class="hero">
  <div class="container">
    <h1>Computer Laboratory<br>Facilities Management</h1>
    <p>Streamline your laboratory operations. Book rooms, borrow equipment, manage resources efficiently.</p>
    @auth
      <a href="{{ route('dashboard') }}" class="btn-hero btn-hero-white">Go to Dashboard</a>
    @else
      <a href="{{ route('login') }}" class="btn-hero btn-hero-white">Get Started</a>
      <a href="#features" class="btn-hero btn-hero-outline">Learn More</a>
    @endauth
  </div>
</section>

<section class="section" id="laboratories">
  <div class="container">
    <div class="section-title">
      <h2>Available Laboratories</h2>
      <p>Book our well-equipped laboratory rooms</p>
    </div>
    <div class="row">
      <div class="col-md-4">
        <div class="card-custom">
          <img src="https://images.unsplash.com/photo-1517502884422-41eaead166d4?w=400&h=250&fit=crop" alt="Lab 1">
          <div class="card-body">
            <h5>Computer Laboratory 1</h5>
            <p>Main lab with 50 workstations for programming and design.</p>
            <span class="badge-custom badge-green">Building A | 50 Seats</span>
          </div>
      </div>
      <div class="col-md-4">
        <div class="card-custom">
          <img src="https://images.unsplash.com/photo-1504384308090-c894fdcc538d?w=400&h=250&fit=crop" alt="Lab 2">
          <div class="card-body">
            <h5>Computer Laboratory 2</h5>
            <p>Advanced computing lab for research and data analysis.</p>
            <span class="badge-custom badge-green">Building A | 40 Seats</span>
          </div>
      </div>
      <div class="col-md-4">
        <div class="card-custom">
          <img src="https://images.unsplash.com/photo-1497366216548-37526070297c?w=400&h=250&fit=crop" alt="Lab 3">
          <div class="card-body">
            <h5>Multimedia Laboratory</h5>
            <p>Creative lab with design workstations and video editing.</p>
            <span class="badge-custom badge-yellow">Building B | 30 Seats</span>
          </div>
      </div>
  </div>
</section>

<section class="section" id="equipment" style="background: white;">
  <div class="container">
    <div class="section-title">
      <h2>Available Equipment</h2>
      <p>Browse and borrow equipment from our inventory</p>
    </div>
    <div class="row">
      <div class="col-md-4">
        <div class="card-custom">
          <img src="https://images.unsplash.com/photo-1496181133206-80ce9b88a853?w=400&h=250&fit=crop" alt="Laptop">
          <div class="card-body">
            <h5>Laptops</h5>
            <p>High-performance laptops for students and staff.</p>
            <span class="badge-custom badge-green">15 Available</span>
          </div>
      </div>
      <div class="col-md-4">
        <div class="card-custom">
          <img src="https://images.unsplash.com/photo-1593640408182-31c70c8268f5?w=400&h=250&fit=crop" alt="Desktop">
          <div class="card-body">
            <h5>Desktop Computers</h5>
            <p>Powerful workstations for heavy tasks.</p>
            <span class="badge-custom badge-green">20 Available</span>
          </div>
      </div>
      <div class="col-md-4">
        <div class="card-custom">
          <img src="https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=400&h=250&fit=crop" alt="Projector">
          <div class="card-body">
            <h5>Projectors</h5>
            <p>HD projectors for presentations.</p>
            <span class="badge-custom badge-yellow">5 Available</span>
          </div>
      </div>
      <div class="col-md-4">
        <div class="card-custom">
          <img src="https://images.unsplash.com/photo-1544244015-0df4b3ffc6b0?w=400&h=250&fit=crop" alt="Tablet">
          <div class="card-body">
            <h5>Tablets</h5>
            <p>iPads for interactive learning.</p>
            <span class="badge-custom badge-green">12 Available</span>
          </div>
      </div>
      <div class="col-md-4">
        <div class="card-custom">
          <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=400&h=250&fit=crop" alt="Headphones">
          <div class="card-body">
            <h5>Headphones</h5>
            <p>Noise-canceling headphones.</p>
            <span class="badge-custom badge-green">30 Available</span>
          </div>
      </div>
      <div class="col-md-4">
        <div class="card-custom">
          <img src="https://images.unsplash.com/photo-1516035069371-29a1b244cc32?w=400&h=250&fit=crop" alt="Camera">
          <div class="card-body">
            <h5>Digital Cameras</h5>
            <p>Professional DSLR cameras.</p>
            <span class="badge-custom badge-yellow">3 Available</span>
          </div>
      </div>
  </div>
</section>

<section class="stats-section">
  <div class="container">
    <div class="row">
      <div class="col-3"><div class="stat-box"><div class="stat-number">500+</div><div class="stat-label">Students</div></div>
      <div class="col-3"><div class="stat-box"><div class="stat-number">50+</div><div class="stat-label">Lab Rooms</div></div>
      <div class="col-3"><div class="stat-box"><div class="stat-number">200+</div><div class="stat-label">Equipment</div></div>
      <div class="col-3"><div class="stat-box"><div class="stat-number">99%</div><div class="stat-label">Uptime</div></div>
  </div>
</section>

<section class="section" id="features">
  <div class="container">
    <div class="section-title">
      <h2>Key Features</h2>
      <p>Everything you need to manage your laboratory</p>
    </div>
    <div class="row">
      <div class="col-md-4">
        <div class="feature-box">
          <div class="feature-icon"><i class="fas fa-calendar-check"></i></div>
          <h5>Easy Reservations</h5>
          <p>Book rooms with just a few clicks.</p>
        </div>
      <div class="col-md-4">
        <div class="feature-box">
          <div class="feature-icon"><i class="fas fa-laptop"></i></div>
          <h5>Equipment Tracking</h5>
          <p>Track availability in real-time.</p>
        </div>
      <div class="col-md-4">
        <div class="feature-box">
          <div class="feature-icon"><i class="fas fa-user-shield"></i></div>
          <h5>Role-Based Access</h5>
          <p>Secure access for all users.</p>
        </div>
    </div>
</section>

<footer>
  <div class="container">
    <p>&copy; 2026 CLFMS | Computer Laboratory Facilities Management System</p>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
</parameter>
</create_file>
