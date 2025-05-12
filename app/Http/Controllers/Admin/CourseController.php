<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        return view('admin.courses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'brief' => 'required|string',
            'fees' => 'required|numeric|min:0',
        ]);

        $thumbnailPath = $request->file('thumbnail')->store('course-thumbnails', 'public');

        Course::create([
            'name' => $request->name,
            'thumbnail' => $thumbnailPath,
            'brief' => $request->brief,
            'fees' => $request->fees,
        ]);

        return redirect()->route('admin.courses.index')->with('success', 'Course created successfully.');
    }

    public function edit(Course $course)
    {
        return view('admin.courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'brief' => 'required|string',
            'fees' => 'required|numeric|min:0',
        ]);

        $data = [
            'name' => $request->name,
            'brief' => $request->brief,
            'fees' => $request->fees,
        ];

        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail
            Storage::disk('public')->delete($course->thumbnail);
            
            // Store new thumbnail
            $thumbnailPath = $request->file('thumbnail')->store('course-thumbnails', 'public');
            $data['thumbnail'] = $thumbnailPath;
        }

        $course->update($data);

        return redirect()->route('admin.courses.index')
            ->with('success', 'Course updated successfully.');
    }

    public function destroy(Course $course)
    {
        // Option 1: If using cascade deletes (just delete)
        // Option 2: If manually handling (delete enrollments first)
        $course->enrollments()->delete();
        
        // Option 3: If using soft deletes (just call delete())
        
        // Always delete the thumbnail
        Storage::disk('public')->delete($course->thumbnail);
        
        $course->delete();

        return redirect()->route('admin.courses.index')
            ->with('success', 'Course deleted successfully.');
    }
}
