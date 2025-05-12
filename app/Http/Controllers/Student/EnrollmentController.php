<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EnrollmentController extends Controller
{
    public function showStep1()
    {
        $courses = Course::all();
        return view('student.enroll.step1', compact('courses'));
    }

    public function processStep1(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
        ]);

        session(['enrollment.course_id' => $request->course_id]);

        return redirect()->route('enroll.step2');
    }

    public function showStep2()
    {
        if (!session()->has('enrollment.course_id')) {
            return redirect()->route('enroll.step1');
        }

        $course = Course::findOrFail(session('enrollment.course_id'));
        return view('student.enroll.step2', compact('course'));
    }

    public function processStep2(Request $request)
    {
        $request->validate([
            'action' => 'required|in:proceed,change',
        ]);

        if ($request->action === 'change') {
            return redirect()->route('enroll.step1');
        }

        return redirect()->route('enroll.step3');
    }

    public function showStep3()
    {
        if (!session()->has('enrollment.course_id')) {
            return redirect()->route('enroll.step1');
        }

        $student = Auth::guard('student')->user();
        $course = Course::findOrFail(session('enrollment.course_id'));

        return view('student.enroll.step3', compact('student', 'course'));
    }
    public function complete(Request $request)
    {
        if (!session()->has('enrollment.course_id')) {
            return redirect()->route('enroll.step1');
        }

        $student = Auth::guard('student')->user();
        $courseId = session('enrollment.course_id');
        $courseName = session('enrollment.course_name'); // Store course name before clearing session

        $lastEnrollment = Enrollment::orderBy('id', 'desc')->first();
        $newEnrollmentNumber = $lastEnrollment ? (int)$lastEnrollment->enrollment + 1 : 12000;

        $enrollment = Enrollment::create([
            'student_id' => $student->id,
            'course_id' => $courseId,
            'status' => 'completed',
            'enrollment' => (string)$newEnrollmentNumber
        ]);

        // Clear session
        session()->forget('enrollment');

        // Pass both id and course_name to the success view
        return redirect()->route('enroll.success', [
            'id' => $enrollment->enrollment,
            'course_name' => $courseName
        ]);
    }

    public function success($id)
    {
        return view('student.enroll.success', [
            'id' => $id,
            'course_name' => request()->course_name
        ]);
    }
}

