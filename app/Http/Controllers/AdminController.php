<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\University;
use App\Models\Course;
use App\Models\Application;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $stats = [
            'universities' => University::count(),
            'courses' => Course::count(),
            'applications' => Application::count(),
            'pending_applications' => Application::where('status', 'Pending')->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
