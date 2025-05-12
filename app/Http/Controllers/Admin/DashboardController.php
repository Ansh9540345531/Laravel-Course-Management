<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Student;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCourses = Course::count();
        $totalStudents = Student::count();
        $totalEnrollments = Enrollment::count();
        $recentEnrollments = Enrollment::with(['student', 'course'])
                                    ->latest()
                                    ->take(5)
                                    ->get();

        return view('admin.dashboard', compact(
            'totalCourses',
            'totalStudents',
            'totalEnrollments',
            'recentEnrollments'
        ));
    }
}