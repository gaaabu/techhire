@extends('layouts.app')

@section('title', 'Applications Received')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-lg-3 sidebar p-3">
            <h5><i class="fas fa-building"></i> Employer Dashboard</h5>
            <hr>
            <nav class="nav flex-column">
                <a class="nav-link" href="{{ route('dashboard') }}"><i class="fas fa-chart-line"></i> Overview</a>
                <a class="nav-link" href="{{ route('jobs.create') }}"><i class="fas fa-plus"></i> Post New Job</a>
                <!-- FIXED LINKS -->
                <a class="nav-link" href="{{ route('dashboard.my_jobs') }}"><i class="fas fa-briefcase"></i> My Jobs</a>
                <a class="nav-link active" href="{{ route('dashboard.applications') }}"><i class="fas fa-file-alt"></i> Applications</a>
            </nav>
        </div>
        
        <div class="col-lg-9">
            <h2 class="mb-4">Applications Received</h2>

            <div class="card shadow-sm border-0">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4">Candidate</th>
                                    <th>Job Title</th>
                                    <th>Applied Date</th>
                                    <th>Resume</th>
                                    <th>Status</th>
                                    <th class="text-end pe-4">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($applications as $app)
                                    <tr>
                                        <td class="ps-4">
                                            <div class="fw-bold">{{ $app->jobSeeker->name ?? 'Unknown User' }}</div>
                                            <small class="text-muted">{{ $app->jobSeeker->email ?? '' }}</small>
                                        </td>
                                        <td>
                                            <a href="{{ route('jobs.show', $app->jobPost) }}" class="text-decoration-none">
                                                {{ $app->jobPost->title }}
                                            </a>
                                        </td>
                                        <td>{{ $app->created_at->format('M d, Y') }}</td>
                                        <td>
                                            @if($app->resume_path)
                                                <a href="{{ asset('storage/' . $app->resume_path) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-download me-1"></i> Download
                                                </a>
                                            @else
                                                <span class="text-muted small">No Resume</span>
                                            @endif
                                            
                                            @if($app->portfolio_links)
                                                <div class="mt-1">
                                                    <a href="{{ $app->portfolio_links }}" target="_blank" class="small text-decoration-none">
                                                        <i class="fas fa-link"></i> Portfolio
                                                    </a>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge bg-{{ $app->status === 'pending' ? 'warning' : ($app->status === 'accepted' ? 'success' : 'danger') }}">
                                                {{ ucfirst($app->status) }}
                                            </span>
                                        </td>
                                        <td class="text-end pe-4">
                                            @if($app->status === 'pending')
                                                <!-- Accept Form -->
                                                <form action="{{ route('applications.updateStatus', $app) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="accepted">
                                                    <button type="submit" class="btn btn-sm btn-success" title="Accept Candidate" onclick="return confirm('Are you sure you want to accept this candidate?')">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                </form>

                                                <!-- Reject Form -->
                                                <form action="{{ route('applications.updateStatus', $app) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="rejected">
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Reject Candidate" onclick="return confirm('Are you sure you want to reject this candidate?')">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </form>
                                            @else
                                                <span class="text-muted small">
                                                    <i class="fas fa-lock"></i> Decided
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-5">
                                            <div class="text-muted">
                                                <i class="fas fa-inbox fa-3x mb-3"></i>
                                                <p>No applications received yet.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if($applications->hasPages())
                    <div class="card-footer bg-white">
                        {{ $applications->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection