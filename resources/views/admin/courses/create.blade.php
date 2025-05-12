@extends('layouts.admin')
@section('title', 'Add New Course')

@section('admin-content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Add New Course</h1>
</div>

<div class="card shadow">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.courses.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Course Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                       id="name" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="thumbnail" class="form-label">Course Thumbnail</label>
                <input type="file" class="form-control @error('thumbnail') is-invalid @enderror" 
                       id="thumbnail" name="thumbnail" required>
                @error('thumbnail')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="form-text">Recommended size: 600x400 pixels</div>
            </div>

            <div class="mb-3">
                <label for="brief" class="form-label">Course Brief</label>
                <textarea class="form-control @error('brief') is-invalid @enderror" 
                          id="brief" name="brief" rows="3" required>{{ old('brief') }}</textarea>
                @error('brief')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="fees" class="form-label">Course Fees (₹)</label>
                <input type="number" step="0.01" class="form-control @error('fees') is-invalid @enderror" 
                       id="fees" name="fees" value="{{ old('fees') }}" required>
                @error('fees')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Save Course</button>
            </div>
        </form>
    </div>
</div>
@endsection