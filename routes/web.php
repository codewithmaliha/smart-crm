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
});

// Staff Routes
Route::middleware(['auth', 'role:staff'])->prefix('staff')->name('staff.')->group(function () {
    Route::get('/dashboard', [StaffController::class, 'index'])->name('dashboard');
    Route::get('/universities', [StaffController::class, 'universities'])->name('universities.index');
    Route::get('/applications/{application}/edit', [StaffController::class, 'edit'])->name('applications.edit');
    Route::put('/applications/{application}', [StaffController::class, 'update'])->name('applications.update');
});

// Student Routes
Route::middleware(['auth', 'role:student'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', [StudentController::class, 'index'])->name('courses.index');
    Route::get('/universities', [StudentController::class, 'universities'])->name('universities.index');
    Route::post('/apply/{course}', [StudentController::class, 'apply'])->name('apply');
    Route::get('/my-applications', [StudentController::class, 'myApplications'])->name('applications.index');
});

require __DIR__.'/auth.php';
