@extends('layouts.student')
@section('title', 'Enrollment - Step 3')

@section('student-content')
<div class="card shadow">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0">Enrollment Process - Step 3</h4>
    </div>
    <div class="card-body">
        <div class="enrollment-steps mb-5">
            <div class="step completed">
                <div class="step-number">1</div>
                <div class="step-title">Select Course</div>
            </div>
            <div class="step completed">
                <div class="step-number">2</div>
                <div class="step-title">Course Details</div>
            </div>
            <div class="step active">
                <div class="step-number">3</div>
                <div class="step-title">Confirmation</div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Student Details</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <li class="mb-2"><strong>Name:</strong> {{ $student->first_name }} {{ $student->last_name }}</li>
                            <li class="mb-2"><strong>Email:</strong> {{ $student->email }}</li>
                            <li class="mb-2"><strong>Mobile:</strong> {{ $student->mobile }}</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Course Details</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <li class="mb-2"><strong>Course Name:</strong> {{ $course->name }}</li>
                            <li class="mb-2"><strong>Fees:</strong> ₹{{ number_format($course->fees, 2) }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="alert alert-info">
            <i class="bi bi-info-circle-fill"></i> Please review your information before submitting.
        </div>

        <form method="POST" action="{{ route('enroll.complete') }}">
            @csrf
            <div class="d-flex justify-content-between">
                <a href="{{ route('enroll.step2') }}" class="btn btn-outline-secondary btn-lg">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
                <button type="submit" class="btn btn-success btn-lg">
                    <i class="bi bi-check-circle"></i> Confirm & Submit
                </button>
            </div>
        </form>
    </div>
</div>
@endsection