<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Application;
use App\Models\ApplicationDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

        // --- AI Recommendation Engine ---
        $user = Auth::user();
        $pastApplications = \App\Models\Application::where('user_id', $user->id)->pluck('course_id')->toArray();
        
        $recommendationQuery = Course::with('university')->whereNotIn('id', $pastApplications);
        
        $hasPreferences = false;
        if (!empty($user->preferences)) {
            $hasPreferences = true;
            $recommendationQuery->where(function($q) use ($user) {
                if (!empty($user->preferences['level'])) {
                    $q->where('level', $user->preferences['level']);
                }
                if (!empty($user->preferences['intake'])) {
                    $q->orWhere('intake', $user->preferences['intake']);
                }
            });
        } elseif (!empty($pastApplications)) {
            // Find patterns in user's past applications to recommend similar ones
            $appliedCourses = Course::whereIn('id', $pastApplications)->get();
            $preferredLevels = $appliedCourses->pluck('level')->unique()->toArray();
            $preferredIntakes = $appliedCourses->pluck('intake')->unique()->toArray();
            
            $recommendationQuery->where(function($q) use ($preferredLevels, $preferredIntakes) {
                $q->whereIn('level', $preferredLevels)
                  ->orWhereIn('intake', $preferredIntakes);
            });
        }
        
        // Get top 3 intelligent matches, fallback to random 3 if nothing strictly matches
        $recommendedCourses = $recommendationQuery->inRandomOrder()->take(3)->get();
        if ($recommendedCourses->count() < 3) {
            $filler = Course::with('university')
                ->whereNotIn('id', array_merge($pastApplications, $recommendedCourses->pluck('id')->toArray()))
                ->inRandomOrder()
                ->take(3 - $recommendedCourses->count())
                ->get();
            $recommendedCourses = $recommendedCourses->merge($filler);
        }
        
        // Let the view know if AI can't generate specific recommendations
        $needsPreferences = !$hasPreferences && empty($pastApplications);

        return view('student.dashboard', compact('courses', 'selectedUniversity', 'recommendedCourses', 'needsPreferences', 'user'));
    }

    public function storePreferences(Request $request)
    {
        $request->validate([
            'level' => 'nullable|string',
            'intake' => 'nullable|string',
        ]);

        $user = Auth::user();
        $user->update([
            'preferences' => [
                'level' => $request->level,
                'intake' => $request->intake,
            ]
        ]);

        return redirect()->back()->with('success', 'Preferences updated successfully! AI recommendations refreshed.');
    }

    public function apply(Course $course)
    {
        // Check if already applied
        $application = Application::where('user_id', Auth::id())
            ->where('course_id', $course->id)
            ->first();

        if ($application) {
            return redirect()->route('student.applications.show', $application);
        }

        return view('student.applications.apply', compact('course'));
    }

    public function storeApplication(Request $request, Course $course)
    {
        $validated = $request->validate([
            'country' => 'required|string',
            'university_name' => 'nullable|string',
            'intake' => 'required|string',
            'name' => 'required|string',
            'passport_number' => 'required|string',
            'dob' => 'required|date',
            'phone' => 'required|string',
            'marital_status' => 'required|string',
            'address' => 'required|string',
            'nationality' => 'required|string',
            'highest_qualification' => 'required|string',
            'passing_year' => 'required|integer',
        ]);

        $application = Application::create([
            'user_id' => Auth::id(),
            'course_id' => $course->id,
            'status' => 'Pending',
            'country' => $request->country,
            'university_name' => $request->university_name,
            'intake' => $request->intake,
            'name' => $request->name,
            'passport_number' => $request->passport_number,
            'dob' => $request->dob,
            'phone' => $request->phone,
            'marital_status' => $request->marital_status,
            'address' => $request->address,
            'nationality' => $request->nationality,
            'highest_qualification' => $request->highest_qualification,
            'passing_year' => $request->passing_year,
        ]);

        $application->load('course.university');
        
        // Notify all staff members about the new application
        $staffMembers = \App\Models\User::where('role', 'staff')->get();
        if ($staffMembers->isNotEmpty()) {
            \Illuminate\Support\Facades\Mail::to($staffMembers)->send(new \App\Mail\NewApplicationReceived($application));
        }

        return redirect()->route('student.applications.show', $application)->with('success', 'Details saved. Please upload the required documents.');
    }

    public function showApplication(Application $application)
    {
        if ($application->user_id !== Auth::id()) {
            abort(403);
        }

        $application->load('documents', 'course.university');
        
        $requiredDocuments = $application->getRequiredDocuments();
        
        return view('student.applications.show', compact('application', 'requiredDocuments'));
    }

    public function previewOffer(Application $application)
    {
        if ($application->user_id !== Auth::id()) {
            abort(403);
        }

        $offerPath = $application->offer_letter;

        if (!$offerPath) {
            abort(404, 'Offer letter not found in application record.');
        }

        // 1. Try public disk
        if (Storage::disk('public')->exists($offerPath)) {
            return Storage::disk('public')->response($offerPath);
        }

        // 2. Try testing path/missing edge conditions
        if (file_exists(public_path('storage/' . $offerPath))) {
            return response()->file(public_path('storage/' . $offerPath));
        }
        
        if (file_exists(storage_path('app/public/' . $offerPath))) {
            return response()->file(storage_path('app/public/' . $offerPath));
        }

        abort(404, 'Offer letter file not physically found.');
    }

    public function uploadDocument(Request $request, Application $application)
    {
        $request->validate([
            'document_name' => 'required|string',
            'document_file' => 'required|file|mimes:pdf,zip|max:10240', // 10MB limit
        ]);

        $path = $request->file('document_file')->store('applications/' . $application->id, 'public');

        // Check if document already exists
        $document = ApplicationDocument::where('application_id', $application->id)
            ->where('name', $request->document_name)
            ->first();

        if ($document) {
            // Delete old file if exists
            Storage::disk('public')->delete($document->file_path);
            $document->update([
                'file_path' => $path,
                'status' => 'Pending',
                'rejection_reason' => null,
            ]);
        } else {
            ApplicationDocument::create([
                'application_id' => $application->id,
                'name' => $request->document_name,
                'file_path' => $path,
                'status' => 'Pending',
            ]);
        }

        // Auto-update application status to 'Document Review' if it was Pending or Rejected
        if (in_array($application->status, ['Pending', 'Rejected'])) {
            $application->update(['status' => 'Document Review']);
        }

        return redirect()->back()->with('success', $request->document_name . ' uploaded successfully.');
    }

    public function myApplications()
    {
        $applications = Application::with(['course.university'])
            ->withCount([
                'documents',
                'documents as approved_documents_count' => function ($query) {
                    $query->where('status', 'Approved');
                }
            ])
            ->where('user_id', Auth::id())
            ->get();
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
