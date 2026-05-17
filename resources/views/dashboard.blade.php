@extends('app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('dashboard.css') }}">
@endpush

@section('content')
<header class="nav-container">
    <div style="font-size: 1.5rem; font-weight: 800; letter-spacing: -1px;">USTP COMPLAINT SYSTEM</div>
    <div style="display:flex; gap:15px;">
        <a href="{{ route('complaints.index') }}" class="btn-dashboard" style="background:transparent; color:#fff; border:1px solid rgba(255,255,255,0.2);">Home</a>
        <a href="{{ route('complaints.history') }}" class="btn-dashboard" style="background:transparent; color:#fff; border:1px solid rgba(255,255,255,0.2);">History Log</a>
        <a href="{{ route('logout') }}" class="btn-dashboard" style="background:#ef4444; color:#fff;">Logout</a>
    </div>
</header>

<div style="padding: 0 8%;">
    @php
        $pPer = $total > 0 ? round(($pending / $total) * 100) : 0;
        $rPer = $total > 0 ? round(($resolved / $total) * 100) : 0;
    @endphp

    <div style="display: grid; grid-template-columns: 350px 1fr; gap: 30px;">
        
        <aside class="glass-panel" style="text-align:center;">
            <div class="chart-item" style="width:100%; margin-bottom:40px;">
                <div class="circular-progress" style="--percent: {{ $pPer }}; --color: #f97316;">
                    <span class="percent-text">{{ $pPer }}%</span>
                </div>
                <h3 style="margin:0;">Pending Issues</h3>
                <p style="color:#94a3b8;">{{ $pending }} Open Cases</p>
            </div>

            <div class="chart-item" style="width:100%; margin-bottom:40px;">
                <div class="circular-progress" style="--percent: {{ $rPer }}; --color: #22c55e;">
                    <span class="percent-text">{{ $rPer }}%</span>
                </div>
                <h3 style="margin:0;">Resolved</h3>
                <p style="color:#94a3b8;">{{ $resolved }} Closed Cases</p>
            </div>

            <div style="border-top: 1px solid rgba(255,255,255,0.1); padding-top:20px;">
                <small style="color:#94a3b8;">TOTAL RECORDS</small>
                <h1 style="margin:0; font-size:3.5rem;">{{ $total }}</h1>
            </div>
        </aside>

        <main class="glass-panel">
            <h2 style="margin-top:0; font-size:1.8rem;">Recent Activity</h2>
            <table>
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Message</th>
                        <th>Status</th>
                        <th style="text-align:right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($complaints as $complaint)
                    <tr>
                        <td><strong>{{ $complaint->name }}</strong></td>
                        <td>{{ Str::limit($complaint->message, 45) }}</td>
                        <td>
                            <span style="padding:4px 10px; border-radius:8px; font-size:0.7rem; font-weight:700; background: {{ $complaint->status === 'Pending' ? 'rgba(249,115,22,0.2)' : 'rgba(34,197,94,0.2)' }}; color: {{ $complaint->status === 'Pending' ? '#fdba74' : '#86efac' }};">
                                {{ strtoupper($complaint->status) }}
                            </span>
                        </td>
                        <td style="text-align:right; display:flex; justify-content:flex-end; gap:8px;">
                            <form method="POST" action="{{ route('complaints.updateStatus', $complaint->id) }}">
                                @csrf
                                <button class="btn-dashboard" style="padding:5px 10px; font-size:0.7rem;">Update</button>
                            </form>
                            <form method="POST" action="{{ route('complaints.destroy', $complaint->id) }}" onsubmit="return confirm('Delete record?')">
                                @csrf @method('DELETE')
                                <button class="btn-dashboard btn-danger" style="padding:5px 10px; font-size:0.7rem;">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </main>
    </div>
</div>
@endsection