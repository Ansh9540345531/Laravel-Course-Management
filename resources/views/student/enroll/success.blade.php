@extends('layouts.student')
@section('title', 'Enrollment Successful')

@section('student-content')

<div class="card shadow">
    <div class="card-body text-center py-5">
        <div class="mb-4">
            <i class="bi bi-check-circle-fill text-success" style="font-size: 5rem;"></i>
        </div>
        <h1 class="mb-3">Enrollment Successful!</h1>
        <p class="lead mb-4">Thank you for enrolling in our course. Your enrollment has been confirmed.</p>
        <div class="alert alert-success col-md-8 mx-auto">
            <h5 class="alert-heading">Course: {{ session('enrollment.course_name') }}</h5>
            <p class="mb-0">We've sent a confirmation email to your registered email address.</p>
        </div>

        <div class="alert alert-success col-md-8 mx-auto">
            <h5 class="alert-heading">Registration Number : </h5>
            <p class="mb-0">{{$id}}</p>
        </div>
        <div class="mt-4">
            <a href="{{ route('enroll.step1') }}" class="btn btn-primary me-2">Enroll in Another Course</a>
            <a href="#" class="btn btn-outline-secondary">Go to Dashboard</a>
        </div>
    </div>
</div>
@endsection