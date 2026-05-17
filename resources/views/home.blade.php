@extends('app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('home.css') }}">
@endpush

@section('content')
    <header class="top-bar">
        <div class="site-title">USTP COMPLAINT SYSTEM</div>
        <nav class="nav-links">
            <a href="{{ route('complaints.index') }}" class="nav-btn">Complaints</a>
            <a href="{{ route('dashboard') }}" class="nav-btn">Dashboard</a>
            <a href="{{ route('complaints.history') }}" class="nav-btn">History</a>
            <a href="{{ route('login') }}" class="nav-btn">Login</a>
        </nav>
    </header>

    <section class="hero">
        <div class="hero-content">
            <h1>Resolve Matters Faster.</h1>
            <p>Our Complaint Management System helps you bridge the gap between problems and solutions through a seamless digital experience.</p>
            <a href="{{ route('complaints.index') }}">
                <button class="btn-primary">Submit a Complaint</button>
            </a>
        </div>
    </section>

    <section class="features">
        <h2>Experience Efficiency</h2>
        <div class="feature-grid">
            <div class="feature-card">
                <div style="font-size: 2rem; margin-bottom: 15px;">📩</div>
                <h3>Easy Submission</h3>
                <p>File reports in under 60 seconds with our intuitive, user-friendly form designed for speed.</p>
            </div>
            <div class="feature-card">
                <div style="font-size: 2rem; margin-bottom: 15px;">📊</div>
                <h3>Live Monitoring</h3>
                <p>Stay informed with real-time status updates on all your submitted complaints.</p>
            </div>
            <div class="feature-card">
                <div style="font-size: 2rem; margin-bottom: 15px;">🕒</div>
                <h3>Admin Control</h3>
                <p>Centralized management tools for admins to track history and resolve issues efficiently.</p>
            </div>
        </div>
    </section>

    <section class="cta">
        <div class="cta-box">
            <h2>Ready to manage the system?</h2>
            <p style="color: #94a3b8; margin-bottom: 30px;">Register an administrator account to start resolving user complaints.</p>
            <a href="{{ route('register') }}">
                <button class="cta-btn register-btn">Get Started</button>
            </a>
            <a href="{{ route('login') }}">
                <button class="cta-btn login-btn">Admin Login</button>
            </a>
        </div>
    </section>

    <footer class="footer">
        <p>&copy; {{ date('Y') }} Complaint Management System. Built for reliability.</p>
    </footer>
@endsection