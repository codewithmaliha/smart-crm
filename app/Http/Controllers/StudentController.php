<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = Course::with('university');

        if ($request->has('university_id')) {
            $query->where('university_id', $request->university_id);
            $selectedUniversity = \App\Models\University::find($request->university_id);
        }

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
        $selectedUniversity = $selectedUniversity ?? null;

        return view('student.dashboard', compact('courses', 'selectedUniversity'));
    }

    public function apply(Course $course)
    {
        // Check if already applied
        $exists = Application::where('user_id', Auth::id())
            ->where('course_id', $course->id)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'You have already applied for this course.');
        }

        Application::create([
            'user_id' => Auth::id(),
            'course_id' => $course->id,
            'status' => 'Pending',
        ]);

        return redirect()->route('student.applications.index')->with('success', 'Application submitted successfully.');
    }

    public function myApplications()
    {
        $applications = Application::with(['course.university'])->where('user_id', Auth::id())->get();
        return view('student.applications', compact('applications'));
    }

    public function universities(Request $request)
    {
        $query = \App\Models\University::withCount('courses');

        if ($request->filled('search') || $request->filled('global_search')) {
            $search = $request->search ?? $request->global_search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('country', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $universities = $query->get();
        return view('universities.index', compact('universities'));
    }
}
