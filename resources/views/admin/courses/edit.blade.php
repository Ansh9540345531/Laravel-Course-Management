@extends('layouts.admin')
@section('title', 'Edit Course')

@section('admin-content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Course</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('admin.courses.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Back to Courses
        </a>
    </div>
</div>

<div class="card shadow">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.courses.update', $course->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Course Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                       id="name" name="name" value="{{ old('name', $course->name) }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="thumbnail" class="form-label">Course Thumbnail</label>
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="{{ $course->name }}" 
                         style="max-width: 200px; height: auto;">
                </div>
                <input type="file" class="form-control @error('thumbnail') is-invalid @enderror" 
                       id="thumbnail" name="thumbnail">
                @error('thumbnail')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="form-text">Leave blank to keep current thumbnail</div>
            </div>

            <div class="mb-3">
                <label for="brief" class="form-label">Course Brief</label>
                <textarea class="form-control @error('brief') is-invalid @enderror" 
                          id="brief" name="brief" rows="5" required>{{ old('brief', $course->brief) }}</textarea>
                @error('brief')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="fees" class="form-label">Course Fees (₹)</label>
                <input type="number" step="0.01" class="form-control @error('fees') is-invalid @enderror" 
                       id="fees" name="fees" value="{{ old('fees', $course->fees) }}" required>
                @error('fees')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Update Course</button>
            </div>
        </form>
    </div>
</div>
@endsection