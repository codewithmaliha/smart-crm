<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = Auth::user();
    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($user->role === 'staff') {
        return redirect()->route('staff.dashboard');
    } else {
        return redirect()->route('student.courses.index');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::resource('universities', \App\Http\Controllers\Admin\UniversityController::class);
    Route::resource('courses', \App\Http\Controllers\Admin\CourseController::class);
    Route::resource('staff', \App\Http\Controllers\Admin\AdminStaffController::class);
});

// Staff Routes
Route::middleware(['auth', 'role:staff'])->prefix('staff')->name('staff.')->group(function () {
    Route::get('/dashboard', [StaffController::class, 'index'])->name('dashboard');
    Route::get('/universities', [StaffController::class, 'universities'])->name('universities.index');
    Route::get('/applications/{application}/review', [\App\Http\Controllers\Staff\StaffApplicationController::class, 'review'])->name('applications.review');
    Route::post('/applications/{application}/documents/{document}/approve', [\App\Http\Controllers\Staff\StaffApplicationController::class, 'approveDocument'])->name('applications.documents.approve');
    Route::post('/applications/{application}/documents/{document}/reject', [\App\Http\Controllers\Staff\StaffApplicationController::class, 'rejectDocument'])->name('applications.documents.reject');
    Route::post('/applications/{application}/offer-letter', [\App\Http\Controllers\Staff\StaffApplicationController::class, 'uploadOfferLetter'])->name('applications.offer-letter');
});

// Student Routes
Route::middleware(['auth', 'role:student'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', [StudentController::class, 'index'])->name('courses.index');
    Route::post('/preferences', [StudentController::class, 'storePreferences'])->name('preferences.store');
    Route::get('/universities', [StudentController::class, 'universities'])->name('universities.index');
    Route::get('/apply/{course}', [StudentController::class, 'apply'])->name('apply');
    Route::post('/apply/{course}', [StudentController::class, 'storeApplication'])->name('apply.store');
    Route::get('/my-applications', [StudentController::class, 'myApplications'])->name('applications.index');
    Route::get('/applications/{application}', [StudentController::class, 'showApplication'])->name('applications.show');
    Route::get('/applications/{application}/preview-offer', [StudentController::class, 'previewOffer'])->name('applications.preview-offer');
    Route::post('/applications/{application}/upload', [StudentController::class, 'uploadDocument'])->name('applications.upload');
});

require __DIR__.'/auth.php';
