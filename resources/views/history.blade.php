@extends('app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('history.css') }}">
@endpush

@section('content')
    <header class="top-bar">
        <div style="font-size: 1.5rem; font-weight: 800; letter-spacing: -1px;">USTP COMPLAINT SYSTEM</div>
        <nav>
            <a href="{{ route('dashboard') }}" class="btn-back">Back to Dashboard</a>
        </nav>
    </header>

    <div class="history-container">
        <div class="glass-panel">
            <h2 style="margin-top:0; font-size:1.8rem;">System Activity Log</h2>
            <p style="color: #94a3b8; margin-bottom:30px;">Tracking all creations, status changes, and deletions across the platform.</p>
            
            <table class="history-table">
                <thead>
                    <tr>
                        <th>Log ID</th>
                        <th>Ref ID</th>
                        <th>Action Performed</th>
                        <th>State</th>
                        <th>Timestamp</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($history as $record)
                        <tr>
                            <td><small>#{{ $record->id }}</small></td>
                            <td><strong>#{{ $record->complaint_id }}</strong></td>
                            <td>{{ $record->action }}</td>
                            <td>
                                @if($record->action === 'Deleted')
                                    <span class="status-tag status-deleted">DELETED</span>
                                @elseif($record->status === 'Resolved')
                                    <span class="status-tag status-resolved">RESOLVED</span>
                                @elseif($record->status === 'Pending')
                                    <span class="status-tag status-pending">PENDING</span>
                                @else
                                    <span class="status-tag" style="background:rgba(255,255,255,0.1);">{{ $record->status }}</span>
                                @endif
                            </td>
                            <td>{{ $record->created_at }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align:center; padding:40px; color:#94a3b8;">No activity history recorded yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <footer class="footer">
        <p>&copy; {{ date('Y') }} Complaint Management System. Security Auditing.</p>
    </footer>
@endsection