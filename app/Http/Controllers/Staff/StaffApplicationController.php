<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\ApplicationDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StaffApplicationController extends Controller
{
    public function review(Application $application)
    {
        $application->load('user', 'course.university', 'documents');
        return view('staff.applications.review', compact('application'));
    }

    public function approveDocument(Application $application, ApplicationDocument $document)
    {
        $document->update(['status' => 'Approved', 'rejection_reason' => null]);
        
        $this->checkAllApproved($application);

        return redirect()->back()->with('success', 'Document approved.');
    }

    public function rejectDocument(Request $request, Application $application, ApplicationDocument $document)
    {
        $request->validate(['reason' => 'required|string']);
        
        $document->update([
            'status' => 'Rejected',
            'rejection_reason' => $request->reason
        ]);

        return redirect()->back()->with('warning', 'Document rejected.');
    }

    public function uploadOfferLetter(Request $request, Application $application)
    {
        $request->validate([
            'offer_letter' => 'required|file|mimes:pdf,zip|max:10240',
        ]);

        $path = $request->file('offer_letter')->store('applications/' . $application->id . '/offer', 'public');
        
        $application->update([
            'offer_letter' => $path,
            'status' => 'Offer Received'
        ]);

        $application->load('course.university', 'user');

        // Notify the student about their offer letter
        if ($application->user) {
            \Illuminate\Support\Facades\Mail::to($application->user)->send(new \App\Mail\OfferLetterReceived($application));
        }

        return redirect()->back()->with('success', 'Offer letter uploaded and student notified.');
    }

    private function checkAllApproved(Application $application)
    {
        $requiredDocs = $application->getRequiredDocuments();
        $requiredCount = count($requiredDocs);
        
        $approvedCount = $application->documents()
            ->whereIn('name', $requiredDocs)
            ->where('status', 'Approved')
            ->count();

        if ($approvedCount >= $requiredCount) {
            $application->update(['status' => 'Submitted to Uni']);
        }
    }
}
