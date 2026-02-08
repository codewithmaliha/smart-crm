<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffController extends Controller
{
    public function index(Request $request)
    {
        $query = Application::with(['user', 'course.university'])->latest();

        if ($request->filled('search') || $request->filled('global_search')) {
            $search = $request->search ?? $request->global_search;
            $query->where(function($q) use ($search) {
                $q->where('status', 'like', "%{$search}%")
                  ->orWhereHas('user', function($uq) use ($search) {
                      $uq->where('name', 'like', "%{$search}%")
                         ->orWhere('email', 'like', "%{$search}%");
                  })
                  ->orWhereHas('course', function($cq) use ($search) {
                      $cq->where('name', 'like', "%{$search}%")
                         ->orWhereHas('university', function($uq) use ($search) {
                             $uq->where('name', 'like', "%{$search}%");
                         });
                  });
            });
        }

        $applications = $query->get();
        
        $stats = [
            'total' => $applications->count(),
            'pending' => $applications->where('status', 'Pending')->count(),
            'enrolled' => $applications->where('status', 'Enrolled')->count(),
            'rejected' => $applications->where('status', 'Rejected')->count(),
        ];

        return view('staff.dashboard', compact('applications', 'stats'));
    }

    public function edit(Application $application)
    {
        return view('staff.applications.edit', compact('application'));
    }

    public function update(Request $request, Application $application)
    {
        $validated = $request->validate([
            'status' => 'required|string|in:Pending,Document Review,Submitted to Uni,Offer Received,Visa Process,Enrolled,Rejected',
        ]);

        $application->update([
            'status' => $validated['status'],
            'staff_id' => Auth::id(),
        ]);

        return redirect()->route('staff.dashboard')->with('success', 'Application status updated successfully.');
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
