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

        return view('student.dashboard', compact('courses', 'selectedUniversity'));
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

        return redirect()->route('student.applications.show', $application)->with('success', 'Details saved. Please upload the required documents.');
    }

    public function showApplication(Application $application)
    {
        if ($application->user_id !== Auth::id()) {
            abort(403);
        }

        $application->load('documents', 'course.university');
        
        $requiredDocuments = [
            'Passport', 'Passport-size Photo', 'Intermediate Certificate',
            'Intermediate Result Card', 'Matriculation Certificate', 'Matriculation Result Card',
            'Medium of Instruction (MOI)', 'CV', 'Experience Letter', 'Supporting Document 1',
            'Supporting Document 2', 'Supporting Document 3', 'Supporting Document 4',
            'Supporting Document 5', 'Fee Receipt'
        ];

        // Conditional documents based on course level
        $courseLevel = strtolower($application->course->level);
        
        if (str_contains($courseLevel, 'master') || str_contains($courseLevel, 'postgraduate')) {
            // If applying for Master, don't ask for Master's degree (they don't have it yet), but DO ask for Bachelor's
            array_splice($requiredDocuments, 2, 0, ["Bachelor's Degree", "Bachelor's Transcript"]);
        } elseif (str_contains($courseLevel, 'bachelor') || str_contains($courseLevel, 'undergraduate')) {
            // If applying for Bachelor, don't ask for Bachelor's degree
            // Intermediate is already in the list
        } else {
            // Default: include both if not clearly undergraduate
            array_splice($requiredDocuments, 2, 0, ["Master's Degree", "Master's Transcript", "Bachelor's Degree", "Bachelor's Transcript"]);
        }

        return view('student.applications.show', compact('application', 'requiredDocuments'));
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
