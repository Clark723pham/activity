@extends('app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('login.css') }}">
@endpush

@section('content')
<header class="top-bar">
    <div style="font-size: 1.2rem; font-weight: 800;">USTP Complaint System</div>
    <nav class="nav-links">
        <a href="{{ url('/') }}">Home</a>
        <a href="{{ route('register') }}">Register</a>
    </nav>
</header>

<section class="auth-section">
    <div class="auth-box">
        <h2>Admin Login</h2>

        @if ($errors->any())
            <div class="alert-danger">
                <ul style="margin:0; padding-left:20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="auth-form">
            @csrf
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <button type="submit" class="auth-btn">Sign In</button>
        </form>
    </div>
</section>

<footer class="footer">
    <p>&copy; {{ date('Y') }} Complaint Management System</p>
</footer>
@endsection