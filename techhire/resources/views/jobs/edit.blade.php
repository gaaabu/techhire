@extends('layouts.app')

@section('title', 'Edit Job')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-edit"></i> Edit Job: {{ $job->title }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('jobs.update', $job) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="title" class="form-label">Job Title *</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" value="{{ old('title', $job->title) }}">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="location" class="form-label">Location *</label>
                                <input type="text" class="form-control @error('location') is-invalid @enderror" 
                                       id="location" name="location" value="{{ old('location', $job->location) }}">
                                @error('location')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="job_type" class="form-label">Job Type *</label>
                                <select class="form-select @error('job_type') is-invalid @enderror" 
                                        id="job_type" name="job_type">
                                    <option value="">Select Job Type</option>
                                    <option value="full_time" {{ old('job_type', $job->job_type) === 'full_time' ? 'selected' : '' }}>Full Time</option>
                                    <option value="part_time" {{ old('job_type', $job->job_type) === 'part_time' ? 'selected' : '' }}>Part Time</option>
                                    <option value="contract" {{ old('job_type', $job->job_type) === 'contract' ? 'selected' : '' }}>Contract</option>
                                    <option value="remote" {{ old('job_type', $job->job_type) === 'remote' ? 'selected' : '' }}>Remote</option>
                                </select>
                                @error('job_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="experience_level" class="form-label">Experience Level *</label>
                                <select class="form-select @error('experience_level') is-invalid @enderror" 
                                        id="experience_level" name="experience_level">
                                    <option value="">Select Experience Level</option>
                                    <option value="entry" {{ old('experience_level', $job->experience_level) === 'entry' ? 'selected' : '' }}>Entry Level</option>
                                    <option value="mid" {{ old('experience_level', $job->experience_level) === 'mid' ? 'selected' : '' }}>Mid Level</option>
                                    <option value="senior" {{ old('experience_level', $job->experience_level) === 'senior' ? 'selected' : '' }}>Senior Level</option>
                                </select>
                                @error('experience_level')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="salary_range" class="form-label">Salary Range (Optional)</label>
                                <input type="text" class="form-control @error('salary_range') is-invalid @enderror" 
                                       id="salary_range" name="salary_range" value="{{ old('salary_range', $job->salary_range) }}">
                                @error('salary_range')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="tech_stack" class="form-label">Technology Stack * (Hold Ctrl/Cmd to select multiple)</label>
                            <select class="form-select @error('tech_stack') is-invalid @enderror" 
                                    id="tech_stack" name="tech_stack[]" multiple size="8">
                                @php
                                    $selectedTech = old('tech_stack', $job->tech_stack);
                                @endphp
                                <option value="JavaScript" {{ in_array('JavaScript', $selectedTech) ? 'selected' : '' }}>JavaScript</option>
                                <option value="Python" {{ in_array('Python', $selectedTech) ? 'selected' : '' }}>Python</option>
                                <option value="Java" {{ in_array('Java', $selectedTech) ? 'selected' : '' }}>Java</option>
                                <option value="PHP" {{ in_array('PHP', $selectedTech) ? 'selected' : '' }}>PHP</option>
                                <option value="C#" {{ in_array('C#', $selectedTech) ? 'selected' : '' }}>C#</option>
                                <option value="React" {{ in_array('React', $selectedTech) ? 'selected' : '' }}>React</option>
                                <option value="Vue.js" {{ in_array('Vue.js', $selectedTech) ? 'selected' : '' }}>Vue.js</option>
                                <option value="Angular" {{ in_array('Angular', $selectedTech) ? 'selected' : '' }}>Angular</option>
                                <option value="Node.js" {{ in_array('Node.js', $selectedTech) ? 'selected' : '' }}>Node.js</option>
                                <option value="Laravel" {{ in_array('Laravel', $selectedTech) ? 'selected' : '' }}>Laravel</option>
                                <option value="Django" {{ in_array('Django', $selectedTech) ? 'selected' : '' }}>Django</option>
                                <option value="MySQL" {{ in_array('MySQL', $selectedTech) ? 'selected' : '' }}>MySQL</option>
                                <option value="PostgreSQL" {{ in_array('PostgreSQL', $selectedTech) ? 'selected' : '' }}>PostgreSQL</option>
                                <option value="MongoDB" {{ in_array('MongoDB', $selectedTech) ? 'selected' : '' }}>MongoDB</option>
                                <option value="AWS" {{ in_array('AWS', $selectedTech) ? 'selected' : '' }}>AWS</option>
                                <option value="Docker" {{ in_array('Docker', $selectedTech) ? 'selected' : '' }}>Docker</option>
                            </select>
                            @error('tech_stack')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="description" class="form-label">Job Description *</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="6">{{ old('description', $job->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="requirements" class="form-label">Requirements *</label>
                            <textarea class="form-control @error('requirements') is-invalid @enderror" 
                                      id="requirements" name="requirements" rows="6">{{ old('requirements', $job->requirements) }}</textarea>
                            @error('requirements')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('jobs.show', $job) }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update Job
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection