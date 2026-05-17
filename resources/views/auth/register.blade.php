@extends('app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('register.css') }}">
@endpush

@section('content')
<header class="top-bar">
    <div class="brand-logo">USTP Complaint System</div>
    <nav class="nav-links">
        <a href="{{ url('/') }}" class="nav-btn">Home</a>
        <a href="{{ route('login') }}" class="nav-btn">Login</a>
    </nav>
</header>

<section class="auth-section">
    <div class="auth-box glass-panel">
        <h2>Create Account</h2>
        <p class="auth-subtitle">Register an administrator profile to manage system logs.</p>

        @if ($errors->any())
            <div class="error-box">
                <ul style="margin:0; padding-left:15px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}" class="auth-form">
            @csrf

            <div class="input-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="John Doe" required autocomplete="off">
            </div>

            <div class="input-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="admin@example.com" required autocomplete="off">
            </div>

            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="••••••••" required>
            </div>

            <div class="input-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="••••••••" required>
            </div>

            <button type="submit" class="auth-btn">Register Account</button>
        </form>
    </div>
</section>

<footer class="footer">
    <p>&copy; {{ date('Y') }} Complaint Management System. Secured Platform.</p>
</footer>
@endsection