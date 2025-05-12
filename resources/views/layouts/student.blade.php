@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    Student Dashboard
                </div>
                <div class="list-group list-group-flush">
                    <a href="{{ route('enroll.step1') }}" class="list-group-item list-group-item-action">New Enrollment</a>
                    <a href="#" class="list-group-item list-group-item-action">My Courses</a>
                    <a href="#" class="list-group-item list-group-item-action">Profile</a>
                    <a href="{{ route('student.logout') }}" class="list-group-item list-group-item-action text-danger" 
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('student.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            @yield('student-content')
        </div>
    </div>
</div>
@endsection