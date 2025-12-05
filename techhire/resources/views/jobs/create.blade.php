@extends('layouts.app')

@section('title', 'Post New Job')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-plus"></i> Post a New Job</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('jobs.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="title" class="form-label">Job Title *</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" value="{{ old('title') }}" 
                                   placeholder="e.g. Senior Full Stack Developer">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="location" class="form-label">Location *</label>
                                <input type="text" class="form-control @error('location') is-invalid @enderror" 
                                       id="location" name="location" value="{{ old('location') }}" 
                                       placeholder="City, Country or Remote">
                                @error('location')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="job_type" class="form-label">Job Type *</label>
                                <select class="form-select @error('job_type') is-invalid @enderror" 
                                        id="job_type" name="job_type">
                                    <option value="">Select Job Type</option>
                                    <option value="full_time" {{ old('job_type') === 'full_time' ? 'selected' : '' }}>Full Time</option>
                                    <option value="part_time" {{ old('job_type') === 'part_time' ? 'selected' : '' }}>Part Time</option>
                                    <option value="contract" {{ old('job_type') === 'contract' ? 'selected' : '' }}>Contract</option>
                                    <option value="remote" {{ old('job_type') === 'remote' ? 'selected' : '' }}>Remote</option>
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
                                    <option value="entry" {{ old('experience_level') === 'entry' ? 'selected' : '' }}>Entry Level (0-2 years)</option>
                                    <option value="mid" {{ old('experience_level') === 'mid' ? 'selected' : '' }}>Mid Level (3-5 years)</option>
                                    <option value="senior" {{ old('experience_level') === 'senior' ? 'selected' : '' }}>Senior Level (5+ years)</option>
                                </select>
                                @error('experience_level')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="salary_range" class="form-label">Salary Range (Optional)</label>
                                <input type="text" class="form-control @error('salary_range') is-invalid @enderror" 
                                       id="salary_range" name="salary_range" value="{{ old('salary_range') }}" 
                                       placeholder="e.g. $60,000 - $80,000">
                                @error('salary_range')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="tech_stack" class="form-label">Technology Stack * (Hold Ctrl/Cmd to select multiple)</label>
                            <select class="form-select @error('tech_stack') is-invalid @enderror" 
                                    id="tech_stack" name="tech_stack[]" multiple size="8">
                                <option value="JavaScript" {{ in_array('JavaScript', old('tech_stack', [])) ? 'selected' : '' }}>JavaScript</option>
                                <option value="Python" {{ in_array('Python', old('tech_stack', [])) ? 'selected' : '' }}>Python</option>
                                <option value="Java" {{ in_array('Java', old('tech_stack', [])) ? 'selected' : '' }}>Java</option>
                                <option value="PHP" {{ in_array('PHP', old('tech_stack', [])) ? 'selected' : '' }}>PHP</option>
                                <option value="C#" {{ in_array('C#', old('tech_stack', [])) ? 'selected' : '' }}>C#</option>
                                <option value="React" {{ in_array('React', old('tech_stack', [])) ? 'selected' : '' }}>React</option>
                                <option value="Vue.js" {{ in_array('Vue.js', old('tech_stack', [])) ? 'selected' : '' }}>Vue.js</option>
                                <option value="Angular" {{ in_array('Angular', old('tech_stack', [])) ? 'selected' : '' }}>Angular</option>
                                <option value="Node.js" {{ in_array('Node.js', old('tech_stack', [])) ? 'selected' : '' }}>Node.js</option>
                                <option value="Laravel" {{ in_array('Laravel', old('tech_stack', [])) ? 'selected' : '' }}>Laravel</option>
                                <option value="Django" {{ in_array('Django', old('tech_stack', [])) ? 'selected' : '' }}>Django</option>
                                <option value="MySQL" {{ in_array('MySQL', old('tech_stack', [])) ? 'selected' : '' }}>MySQL</option>
                                <option value="PostgreSQL" {{ in_array('PostgreSQL', old('tech_stack', [])) ? 'selected' : '' }}>PostgreSQL</option>
                                <option value="MongoDB" {{ in_array('MongoDB', old('tech_stack', [])) ? 'selected' : '' }}>MongoDB</option>
                                <option value="AWS" {{ in_array('AWS', old('tech_stack', [])) ? 'selected' : '' }}>AWS</option>
                                <option value="Docker" {{ in_array('Docker', old('tech_stack', [])) ? 'selected' : '' }}>Docker</option>
                            </select>
                            @error('tech_stack')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="description" class="form-label">Job Description *</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="6" 
                                      placeholder="Describe the role, responsibilities, and what you're looking for...">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="requirements" class="form-label">Requirements *</label>
                            <textarea class="form-control @error('requirements') is-invalid @enderror" 
                                      id="requirements" name="requirements" rows="6" 
                                      placeholder="List the required skills, experience, and qualifications...">{{ old('requirements') }}</textarea>
                            @error('requirements')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('dashboard') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Post Job
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection