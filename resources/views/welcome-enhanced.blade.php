@extends('layouts.app')

@section('title', 'ITMSF - Information Technology Management for Student and Faculty')

@section('styles')
<style>
    /* Hero Section */
    .hero {
        background: linear-gradient(135deg, #0284c7 0%, #0ea5e9 50%, #10b981 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
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
        background: url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.1"%3E%3Cpath d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');
        animation: float 20s ease-in-out infinite;
    }
    
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(20px); }
    }
    
    .hero-content {
        position: relative;
        z-index: 2;
        text-align: center;
        color: white;
    }
    
    .hero h1 {
        font-size: 4rem;
        font-weight: 900;
        margin-bottom: 20px;
        letter-spacing: -2px;
        line-height: 1.1;
    }
    
    .hero p {
        font-size: 1.3rem;
        margin-bottom: 40px;
        opacity: 0.95;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
        line-height: 1.6;
    }
    
    .hero-buttons {
        display: flex;
        gap: 20px;
        justify-content: center;
        flex-wrap: wrap;
    }
    
    .btn-hero {
        padding: 15px 40px;
        font-size: 1rem;
        font-weight: 600;
        border-radius: 10px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        text-decoration: none;
        display: inline-block;
        cursor: pointer;
        border: none;
    }
    
    .btn-hero-primary {
        background: white;
        color: #0284c7;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
    }
    
    .btn-hero-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 50px rgba(0, 0, 0, 0.3);
    }
    
    .btn-hero-secondary {
        background: rgba(255, 255, 255, 0.2);
        color: white;
        border: 2px solid white;
        backdrop-filter: blur(10px);
    }
    
    .btn-hero-secondary:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: translateY(-3px);
    }
    
    /* Features Section */
    .features-section {
        padding: 80px 0;
        background: #f8fafc;
    }
    
    .section-title {
        text-align: center;
        margin-bottom: 60px;
    }
    
    .section-title h2 {
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 15px;
        background: linear-gradient(135deg, #0ea5e9 0%, #10b981 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .section-title p {
        font-size: 1.1rem;
        color: #64748b;
        max-width: 500px;
        margin-left: auto;
        margin-right: auto;
    }
    
    .feature-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
    }
    
    .feature-card {
        background: white;
        border-radius: 16px;
        padding: 40px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
        cursor: pointer;
    }
    
    .feature-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(90deg, #0ea5e9, #10b981);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .feature-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.12);
    }
    
    .feature-card:hover::before {
        transform: scaleX(1);
    }
    
    .feature-icon {
        font-size: 3rem;
        margin-bottom: 20px;
        background: linear-gradient(135deg, #0ea5e9 0%, #10b981 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        display: inline-block;
        transition: transform 0.3s ease;
    }
    
    .feature-card:hover .feature-icon {
        transform: scale(1.1) rotate(5deg);
    }
    
    .feature-card h3 {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 15px;
        color: #1e293b;
    }
    
    .feature-card p {
        color: #64748b;
        line-height: 1.6;
        font-size: 0.95rem;
    }
    
    /* Stats Section */
    .stats-section {
        padding: 80px 0;
        background: linear-gradient(135deg, #0284c7 0%, #0ea5e9 50%, #10b981 100%);
        color: white;
    }
    
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 40px;
        text-align: center;
    }
    
    .stat-item h3 {
        font-size: 2.5rem;
        font-weight: 900;
        margin-bottom: 10px;
    }
    
    .stat-item p {
        font-size: 1.1rem;
        opacity: 0.9;
    }
    
    /* CTA Section */
    .cta-section {
        padding: 80px 0;
        background: #f8fafc;
        text-align: center;
    }
    
    .cta-content h2 {
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 20px;
        color: #1e293b;
    }
    
    .cta-content p {
        font-size: 1.1rem;
        color: #64748b;
        margin-bottom: 40px;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }
    
    /* Animation utilities for GSAP */
    [data-scroll] {
        opacity: 0;
        transform: translateY(30px);
    }
    
    /* Alpine.js dropdown */
    [x-cloak] {
        display: none !important;
    }
</style>
@endsection

@section('content')
<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light" x-data="navAnimation()" x-init="init()">
    <div class="container-lg">
        <a class="navbar-brand" href="#" @click="scrollTo('hero')">ITMSF</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#features" @click="scrollTo('features')">Features</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#stats" @click="scrollTo('stats')">Statistics</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#cta" @click="scrollTo('cta')">Get Started</a>
                </li>
                @if (Route::has('login'))
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/dashboard') }}">Dashboard</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                    @endauth
                @endif
            </ul>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<section class="hero" id="hero">
    <div class="hero-content" data-scroll data-aos="fade-down" data-aos-duration="600">
        <h1 class="mb-0" x-data="{ text: 'ITMSF' }" @mouseenter="animateText" x-cloak data-aos="fade-down" data-aos-delay="100">
            Information Technology Management System
        </h1>
        <p data-aos="fade-up" data-aos-delay="150">Streamline equipment borrowing, incident reporting, and management operations with our modern platform for students and faculty.</p>
        <div class="hero-buttons" data-aos="zoom-in" data-aos-delay="300">
            <button class="btn-hero btn-hero-primary" @click="scrollTo('cta')">Get Started</button>
            <a href="#features" class="btn-hero btn-hero-secondary" @click="scrollTo('features')">Learn More</a>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="features-section" id="features">
    <div class="container-lg">
        <div class="section-title" data-scroll data-aos="fade-down" data-aos-duration="600">
            <h2 data-aos="fade-down" data-aos-delay="100">Powerful Features</h2>
            <p data-aos="fade-down" data-aos-delay="150">Everything you need to manage your laboratory facilities efficiently</p>
        </div>
        
        <div class="feature-grid">
            <!-- Feature 1 -->
            <div class="feature-card" data-scroll x-data="{ hover: false }" @mouseenter="hover = true" @mouseleave="hover = false" data-aos="fade-up" data-aos-delay="100">
                <div class="feature-icon">
                    <i class="fas fa-server"></i>
                </div>
                <h3>Equipment Management</h3>
                <p>Track and manage all laboratory equipment with detailed specifications, maintenance schedules, and status monitoring in real-time.</p>
            </div>
            
            <!-- Feature 2 -->
            <div class="feature-card" data-scroll x-data="{ hover: false }" @mouseenter="hover = true" @mouseleave="hover = false" data-aos="fade-up" data-aos-delay="150">
                <div class="feature-icon">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <h3>Reservation System</h3>
                <p>Simple and intuitive reservations with calendar integration, automatic conflict detection, and email notifications.</p>
            </div>
            
            <!-- Feature 3 -->
            <div class="feature-card" data-scroll x-data="{ hover: false }" @mouseenter="hover = true" @mouseleave="hover = false" data-aos="fade-up" data-aos-delay="200">
                <div class="feature-icon">
                    <i class="fas fa-exchange-alt"></i>
                </div>
                <h3>Borrowing Operations</h3>
                <p>Manage equipment loans with check-out/check-in tracking, due dates, and automated return reminders.</p>
            </div>
            
            <!-- Feature 4 -->
            <div class="feature-card" data-scroll x-data="{ hover: false }" @mouseenter="hover = true" @mouseleave="hover = false" data-aos="fade-up" data-aos-delay="250">
                <div class="feature-icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <h3>Incident Reporting</h3>
                <p>Report and track incidents with severity levels, quick resolution tracking, and follow-up workflows.</p>
            </div>
            
            <!-- Feature 5 -->
            <div class="feature-card" data-scroll x-data="{ hover: false }" @mouseenter="hover = true" @mouseleave="hover = false" data-aos="fade-up" data-aos-delay="300">
                <div class="feature-icon">
                    <i class="fas fa-bell"></i>
                </div>
                <h3>Smart Notifications</h3>
                <p>Get real-time alerts for reservations, equipment status changes, and important system events.</p>
            </div>
            
            <!-- Feature 6 -->
            <div class="feature-card" data-scroll x-data="{ hover: false }" @mouseenter="hover = true" @mouseleave="hover = false" data-aos="fade-up" data-aos-delay="350">
                <div class="feature-icon">
                    <i class="fas fa-chart-bar"></i>
                </div>
                <h3>Analytics & Reporting</h3>
                <p>Comprehensive dashboards and reports to analyze usage patterns and facility utilization.</p>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="stats-section" id="stats">
    <div class="container-lg">
        <div class="stats-grid">
            <div class="stat-item" data-scroll data-aos="fade-up" data-aos-delay="100">
                <h3 class="counter" data-target="500">0</h3>
                <p>Laboratories</p>
            </div>
            <div class="stat-item" data-scroll data-aos="fade-up" data-aos-delay="150">
                <h3 class="counter" data-target="2500">0</h3>
                <p>Equipment Units</p>
            </div>
            <div class="stat-item" data-scroll data-aos="fade-up" data-aos-delay="200">
                <h3 class="counter" data-target="10000">0</h3>
                <p>Active Users</p>
            </div>
            <div class="stat-item" data-scroll data-aos="fade-up" data-aos-delay="250">
                <h3 class="counter" data-target="99.9">0</h3>
                <p>Uptime %</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section" id="cta">
    <div class="container-lg">
        <div class="cta-content" data-scroll data-aos="fade-down" data-aos-duration="600">
            <h2 data-aos="fade-down" data-aos-delay="100">Ready to Transform Your IT Equipment Management?</h2>
            <p data-aos="fade-up" data-aos-delay="150">Join hundreds of institutions using ITMSF to streamline their equipment operations for students and faculty.</p>
            <div class="hero-buttons" data-aos="zoom-in" data-aos-delay="300">
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn btn-primary">Sign Up Today</a>
                @endif
                @if (Route::has('login'))
                    <a href="{{ route('login') }}" class="btn btn-outline-primary">Login to Dashboard</a>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="mdc-elevation-1">
    <div class="container-lg">
        <div class="row mb-4">
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="100">
                <h5 class="gradient-text mb-3">ITMSF</h5>
                <p>Information Technology Management for Student and Faculty</p>
            </div>
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="150">
                <h5>Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a href="#features">Features</a></li>
                    <li><a href="#stats">Statistics</a></li>
                    <li><a href="#cta">Get Started</a></li>
                </ul>
            </div>
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="200">
                <h5>Follow Us</h5>
                <div>
                    <a href="#" class="me-3"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="me-3"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-linkedin"></i></a>
                </div>
            </div>
        </div>
        <hr style="border-color: rgba(255,255,255,0.1);">
        <p class="text-center mb-0" data-aos="fade-up" data-aos-delay="300">&copy; 2026 ITMSF. All rights reserved.</p>
    </div>
</footer>

@endsection

@section('scripts')
<script>
    // Navigation animation with Alpine.js
    document.addEventListener('alpine:init', () => {
        Alpine.data('navAnimation', () => ({
            init() {
                // Smooth scroll to section
                window.scrollTo = (elementId) => {
                    event.preventDefault();
                    const element = document.getElementById(elementId);
                    if (element) {
                        gsap.to(window, {
                            scrollTo: { y: element, autoKill: true },
                            duration: 1,
                            ease: 'power3.inOut'
                        });
                    }
                };
                
                // Navbar animation on scroll
                window.addEventListener('scroll', () => {
                    const navbar = document.querySelector('.navbar');
                    if (window.scrollY > 50) {
                        gsap.to(navbar, { boxShadow: '0 4px 20px rgba(0,0,0,0.08)', duration: 0.3 });
                    } else {
                        gsap.to(navbar, { boxShadow: '0 1px 2px 0 rgba(0,0,0,0.05)', duration: 0.3 });
                    }
                });
            },
        }));
    });
    
    // Text animation on hover
    document.addEventListener('alpine:init', () => {
        Alpine.data('textAnimation', () => ({
            animateText(event) {
                const letters = event.target.textContent.split('');
                gsap.to(event.target, {
                    opacity: 0,
                    duration: 0.3,
                    onComplete: () => {
                        event.target.textContent = '';
                        letters.forEach((letter, index) => {
                            const span = document.createElement('span');
                            span.textContent = letter;
                            span.style.display = 'inline-block';
                            span.style.opacity = '0';
                            event.target.appendChild(span);
                            
                            gsap.to(span, {
                                opacity: 1,
                                y: 0,
                                duration: 0.4,
                                delay: index * 0.05,
                                ease: 'back.out'
                            });
                        });
                    }
                });
            }
        }));
    });
    
    // Counter animation for stats
    document.addEventListener('DOMContentLoaded', () => {
        const counters = document.querySelectorAll('.counter');
        const observerOptions = {
            threshold: 0.5
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && !entry.target.dataset.counted) {
                    const target = parseInt(entry.target.dataset.target);
                    gsap.to(entry.target, {
                        innerText: target,
                        duration: 2.5,
                        ease: 'power2.out',
                        snap: { innerText: 1 },
                        onComplete: () => {
                            entry.target.innerText = target;
                        }
                    });
                    entry.target.dataset.counted = true;
                }
            });
        }, observerOptions);
        
        counters.forEach(counter => observer.observe(counter));
    });
    
    // GSAP Scroll animations
    gsap.registerPlugin(ScrollTrigger);
    
    // Initialize AOS
    AOS.init({
        duration: 600,
        easing: 'ease-out-cubic',
        once: false,
        mirror: true,
        offset: 100
    });
    
    // Animate all elements with data-scroll on scroll
    gsap.utils.toArray('[data-scroll]').forEach((element) => {
        gsap.fromTo(element, {
            opacity: 0,
            y: 30,
        }, {
            opacity: 1,
            y: 0,
            duration: 0.8,
            ease: 'power2.out',
            scrollTrigger: {
                trigger: element,
                start: 'top 80%',
                toggleActions: 'play none none none',
            }
        });
    });
    
    // Stagger animation for feature cards
    gsap.to('.feature-card', {
        stagger: 0.2,
        scrollTrigger: {
            trigger: '.feature-grid',
            start: 'top 80%',
            toggleActions: 'play none none none',
        }
    });
</script>
@endsection
