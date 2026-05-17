@extends('app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('index.css') }}">
@endpush

@section('content')
    <header class="top-bar">
        <div style="font-size: 1.5rem; font-weight: 800; letter-spacing: -1px;">USTP COMPLAINT SYSTEM</div>
        <nav class="nav-links">
            <a href="{{ url('/') }}" class="nav-btn">Home</a>
            <a href="{{ route('dashboard') }}" class="nav-btn">Dashboard</a>
            <a href="{{ route('login') }}" class="nav-btn">Login</a>
        </nav>
    </header>

    <div class="complaints-container">
        
        <div class="glass-card">
            <h2 style="margin-top:0; font-size:2rem;">Submit a Complaint</h2>
            <p style="color: #94a3b8; margin-bottom:25px;">Please provide details regarding your concern. Our team will review it shortly.</p>
            
            <form method="POST" action="{{ route('complaints.store') }}" class="form-box">
                @csrf
                <input type="text" name="name" placeholder="Your Full Name" required>
                <textarea name="message" rows="4" placeholder="Describe your complaint in detail..." required></textarea>
                <button type="submit" class="hero-btn">Send Report</button>
            </form>

            @if(session('success'))
                <div style="margin-top:20px; color:#86efac; background:rgba(34,197,94,0.1); padding:15px; border-radius:12px;">
                    ✔ {{ session('success') }}
                </div>
            @endif
        </div>

        <div class="glass-card">
            <h2 style="margin-top:0;">Recent Submissions</h2>
            <table class="complaints-table">
                <thead>
                    <tr>
                        <th>Ref ID</th>
                        <th>User</th>
                        <th>Complaint</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($complaints as $complaint)
                        <tr>
                            <td><small>#{{ $complaint->id }}</small></td>
                            <td><strong>{{ $complaint->name }}</strong></td>
                            <td>{{ Str::limit($complaint->message, 50) }}</td>
                            <td>
                                <span class="status-badge {{ strtolower($complaint->status) == 'pending' ? 'status-pending' : 'status-resolved' }}">
                                    {{ strtoupper($complaint->status) }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

    <footer class="footer">
        <p>&copy; {{ date('Y') }} Complaint Management System. Professional Accountability.</p>
    </footer>
@endsection