@extends('layouts.admin')
@section('title', 'Manage Courses')

@section('admin-content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Manage Courses</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('admin.courses.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add New Course
        </a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card shadow">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Thumbnail</th>
                        <th>Course Name</th>
                        <th>Fees</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($courses as $course)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="{{ $course->name }}" 
                                     style="width: 60px; height: 60px; object-fit: cover;">
                            </td>
                            <td>{{ $course->name }}</td>
                            <td>₹{{ number_format($course->fees, 2) }}</td>
                            <td>
                                <a href="{{ route('admin.courses.edit', $course->id) }}" 
                                   class="btn btn-sm btn-outline-primary" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.courses.destroy', $course->id) }}" 
                                      method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" 
                                            onclick="return confirm('Are you sure?')" title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No courses found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection