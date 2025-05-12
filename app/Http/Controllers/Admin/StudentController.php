<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::query();

        if ($request->has('course_id')) {
            $query->whereHas('enrollments', function($q) use ($request) {
                $q->where('course_id', $request->course_id);
            });
        }

        $students = $query->with('enrollments.course')->paginate(10);
        $courses = Course::all();

        return view('admin.students.index', compact('students', 'courses'));
    }

    public function export(Request $request)
    {
        $students = Student::query();

        if ($request->has('course_id')) {
            $students->whereHas('enrollments', function($q) use ($request) {
                $q->where('course_id', $request->course_id);
            });
        }

        $students = $students->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="students.csv"',
        ];

        $callback = function() use ($students) {
            $file = fopen('php://output', 'w');
            
            // Header
            fputcsv($file, ['ID', 'Name', 'Email', 'Mobile', 'Registered At']);
            
            // Data
            foreach ($students as $student) {
                fputcsv($file, [
                    $student->id,
                    $student->first_name . ' ' . $student->last_name,
                    $student->email,
                    $student->mobile,
                    $student->created_at->format('Y-m-d H:i:s'),
                ]);
            }
            
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}