@extends('layouts.admin')
@section('title', 'Manage Students')

@section('admin-content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Manage Students</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('admin.students.export') }}" class="btn btn-outline-success me-2">
            <i class="bi bi-download"></i> Export to CSV
        </a>
    </div>
</div>

<div class="card shadow">
    <div class="card-body">
        <form method="GET" class="mb-4">
            <div class="row">
                <div class="col-md-4">
                    <label for="course_id" class="form-label">Filter by Course</label>
                    <select class="form-select" id="course_id" name="course_id">
                        <option value="">All Courses</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}" {{ request('course_id') == $course->id ? 'selected' : '' }}>
                                {{ $course->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary me-2">Filter</button>
                    <a href="{{ route('admin.students.index') }}" class="btn btn-outline-secondary">Reset</a>
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Student Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Registered On</th>
                        <th>Enrollments</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($students as $student)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                            <td>{{ $student->email }}</td>
                            <td>{{ $student->mobile }}</td>
                            <td>{{ $student->created_at->format('d M Y') }}</td>
                            <td>
                                @foreach($student->enrollments as $enrollment)
                                    <span class="badge bg-primary">{{ $enrollment->course->name }}</span>
                                @endforeach
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No students found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $students->links() }}
        </div>
    </div>
</div>
@endsection