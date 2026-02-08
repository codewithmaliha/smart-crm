<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\University;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Course::with('university');

        if ($request->filled('search') || $request->filled('global_search')) {
            $search = $request->search ?? $request->global_search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('level', 'like', "%{$search}%")
                  ->orWhere('intake', 'like', "%{$search}%")
                  ->orWhereHas('university', function($uq) use ($search) {
                      $uq->where('name', 'like', "%{$search}%");
                  });
            });
        }

        $courses = $query->get();
        return view('admin.courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $universities = University::all();
        return view('admin.courses.create', compact('universities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'university_id' => 'required|exists:universities,id',
            'name' => 'required|string|max:255',
            'level' => 'required|string|max:255',
            'intake' => 'required|string|max:255',
            'tuition_fee' => 'nullable|numeric',
            'duration' => 'nullable|string|max:255',
        ]);

        Course::create($validated);

        return redirect()->route('admin.courses.index')->with('success', 'Course created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        $universities = University::all();
        return view('admin.courses.edit', compact('course', 'universities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'university_id' => 'required|exists:universities,id',
            'name' => 'required|string|max:255',
            'level' => 'required|string|max:255',
            'intake' => 'required|string|max:255',
            'tuition_fee' => 'nullable|numeric',
            'duration' => 'nullable|string|max:255',
        ]);

        $course->update($validated);

        return redirect()->route('admin.courses.index')->with('success', 'Course updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('admin.courses.index')->with('success', 'Course deleted successfully.');
    }
}
