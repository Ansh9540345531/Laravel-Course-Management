@extends('layouts.app')

@section('title', 'Welcome')
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <h1 class="display-4 mb-4">Welcome to Our Course Platform</h1>
            <p class="lead mb-5">Start your Course journey today.</p>
            
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <i class="bi bi-person-plus display-4 text-primary mb-3"></i>
                            <h3>Student Registration</h3>
                            <p>Register as a student to enroll in our courses.</p>
                            <a href="{{ route('student.register') }}" class="btn btn-primary">Register Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <i class="bi bi-box-arrow-in-right display-4 text-success mb-3"></i>
                            <h3>Admin Login</h3>
                            <p>Administrators can login here to manage courses and student enrollments.</p>
                            <a href="{{ route('admin.login') }}" class="btn btn-success">Admin Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection