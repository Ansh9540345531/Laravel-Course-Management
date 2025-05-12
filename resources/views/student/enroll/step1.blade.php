@extends('layouts.student')
@section('title', 'Enrollment - Step 1')

@section('student-content')
<div class="card shadow">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0">Enrollment Process - Step 1</h4>
    </div>
    <div class="card-body">
        <div class="enrollment-steps mb-5">
            <div class="step active">
                <div class="step-number">1</div>
                <div class="step-title">Select Course</div>
            </div>
            <div class="step">
                <div class="step-number">2</div>
                <div class="step-title">Course Details</div>
            </div>
            <div class="step">
                <div class="step-number">3</div>
                <div class="step-title">Confirmation</div>
            </div>
        </div>

        <form method="POST" action="{{ route('enroll.process.step1') }}">
            @csrf

            <div class="mb-4">
                <label for="course_id" class="form-label fs-5">Select Course</label>
                <select class="form-select form-select-lg @error('course_id') is-invalid @enderror" 
                        id="course_id" name="course_id" required>
                    <option value="">-- Select a Course --</option>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
                            {{ $course->name }} - ₹{{ number_format($course->fees, 2) }}
                        </option>
                    @endforeach
                </select>
                @error('course_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-lg">Continue to Step 2</button>
            </div>
        </form>
    </div>
</div>
@endsection