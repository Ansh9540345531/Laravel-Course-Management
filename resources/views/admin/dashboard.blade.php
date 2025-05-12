@extends('layouts.admin')
@section('title', 'Admin Dashboard')

@section('admin-content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard</h1>
</div>

<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase">Total Courses</h6>
                        <h2 class="mb-0">{{ $totalCourses }}</h2>
                    </div>
                    <i class="bi bi-book" style="font-size: 2rem;"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card bg-success text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase">Total Students</h6>
                        <h2 class="mb-0">{{ $totalStudents }}</h2>
                    </div>
                    <i class="bi bi-people" style="font-size: 2rem;"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card bg-info text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase">Total Enrollments</h6>
                        <h2 class="mb-0">{{ $totalEnrollments }}</h2>
                    </div>
                    <i class="bi bi-clipboard-check" style="font-size: 2rem;"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card shadow">
    <div class="card-header bg-dark text-white">
        <h5 class="mb-0">Recent Enrollments</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Student</th>
                        <th>Course</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentEnrollments as $enrollment)
                        <tr>
                            <td>{{ $enrollment->student->first_name }} {{ $enrollment->student->last_name }}</td>
                            <td>{{ $enrollment->course->name }}</td>
                            <td>{{ $enrollment->created_at->format('d M Y') }}</td>
                            <td><span class="badge bg-success">{{ $enrollment->status }}</span></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">No enrollments found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection