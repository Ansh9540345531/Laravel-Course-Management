@extends('layouts.app')

@section('title', 'Student Registration')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Student Registration</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('student.register') }}">
                    @csrf

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="first_name" class="form-label">First Name</label>
                            <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" 
                                   name="first_name" value="{{ old('first_name') }}" required autofocus>
                            @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" 
                                   name="last_name" value="{{ old('last_name') }}" required>
                            @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                               name="email" value="{{ old('email') }}" required>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="mobile" class="form-label">Mobile Number</label>
                        <input id="mobile" type="tel" class="form-control @error('mobile') is-invalid @enderror" 
                               name="mobile" value="{{ old('mobile') }}" required>
                        @error('mobile')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="password" class="form-label">Password</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                                   name="password" required>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="password-confirm" class="form-label">Confirm Password</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg">Register</button>
                    </div>

                    <div class="mt-3 text-center">
                        Already have an account? <a href="{{ route('student.login') }}">Login here</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection