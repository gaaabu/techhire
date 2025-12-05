@extends('layouts.app')

@section('title', 'My Jobs')

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
                <a class="nav-link active" href="{{ route('dashboard.my_jobs') }}"><i class="fas fa-briefcase"></i> My Jobs</a>
                <a class="nav-link" href="{{ route('dashboard.applications') }}"><i class="fas fa-file-alt"></i> Applications</a>
            </nav>
        </div>
        
        <div class="col-lg-9">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Manage My Jobs</h2>
                <a href="{{ route('jobs.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Post New Job
                </a>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4">Job Title</th>
                                    <th>Status</th>
                                    <th>Posted Date</th>
                                    <th>Applicants</th>
                                    <th class="text-end pe-4">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($jobs as $job)
                                    <tr>
                                        <td class="ps-4">
                                            <a href="{{ route('jobs.show', $job) }}" class="fw-bold text-decoration-none text-dark">
                                                {{ $job->title }}
                                            </a>
                                            <div class="small text-muted">{{ $job->location }} • {{ ucfirst(str_replace('_', ' ', $job->job_type)) }}</div>
                                        </td>
                                        <td>
                                            <span class="badge bg-{{ $job->status === 'active' ? 'success' : 'secondary' }}">
                                                {{ ucfirst($job->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $job->created_at->format('M d, Y') }}</td>
                                        <td>
                                            <i class="fas fa-users text-muted me-1"></i> {{ $job->applications_count }}
                                        </td>
                                        <td class="text-end pe-4">
                                            <div class="btn-group">
                                                <a href="{{ route('jobs.edit', $job) }}" class="btn btn-sm btn-outline-secondary" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('jobs.destroy', $job) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this job?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-5">
                                            <div class="text-muted">
                                                <i class="fas fa-briefcase fa-3x mb-3"></i>
                                                <p>You haven't posted any jobs yet.</p>
                                                <a href="{{ route('jobs.create') }}" class="btn btn-outline-primary btn-sm">Create First Job</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if($jobs->hasPages())
                    <div class="card-footer bg-white">
                        {{ $jobs->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection