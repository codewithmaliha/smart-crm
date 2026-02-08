<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\University;
use Illuminate\Http\Request;

class UniversityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = University::query();

        if ($request->filled('search') || $request->filled('global_search')) {
            $search = $request->search ?? $request->global_search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('country', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $universities = $query->get();
        return view('admin.universities.index', compact('universities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.universities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'website' => 'nullable|url',
            'description' => 'nullable|string',
        ]);

        University::create($validated);

        return redirect()->route('admin.universities.index')->with('success', 'University created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(University $university)
    {
        return view('admin.universities.edit', compact('university'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, University $university)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'website' => 'nullable|url',
            'description' => 'nullable|string',
        ]);

        $university->update($validated);

        return redirect()->route('admin.universities.index')->with('success', 'University updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(University $university)
    {
        $university->delete();
        return redirect()->route('admin.universities.index')->with('success', 'University deleted successfully.');
    }
}
