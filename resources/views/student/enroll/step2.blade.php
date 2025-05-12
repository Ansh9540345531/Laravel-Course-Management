@extends('layouts.student')
@section('title', 'Enrollment - Step 2')

@section('student-content')
<div class="card shadow">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0">Enrollment Process - Step 2</h4>
    </div>
    <div class="card-body">
        <div class="enrollment-steps mb-5">
            <div class="step completed">
                <div class="step-number">1</div>
                <div class="step-title">Select Course</div>
            </div>
            <div class="step active">
                <div class="step-number">2</div>
                <div class="step-title">Course Details</div>
            </div>
            <div class="step">
                <div class="step-number">3</div>
                <div class="step-title">Confirmation</div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-4 mb-md-0">
                <div class="card h-100">
                    <img src="{{ asset('storage/' . $course->thumbnail) }}" class="card-img-top" alt="{{ $course->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $course->name }}</h5>
                        <h4 class="text-primary">₹{{ number_format($course->fees, 2) }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <h3 class="mb-3">Course Details</h3>
                <div class="mb-4">
                    {!! $course->brief !!}
                </div>

                <form method="POST" action="{{ route('enroll.process.step2') }}">
                    @csrf
                    <div class="d-flex justify-content-between">
                        <button type="submit" name="action" value="change" class="btn btn-outline-secondary btn-lg">
                            <i class="bi bi-arrow-left"></i> Change Course
                        </button>
                        <button type="submit" name="action" value="proceed" class="btn btn-primary btn-lg">
                            Proceed to Confirmation <i class="bi bi-arrow-right"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection