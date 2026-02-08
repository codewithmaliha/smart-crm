<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Student
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->enum('status', ['Pending', 'Document Review', 'Submitted to Uni', 'Offer Received', 'Visa Process', 'Enrolled', 'Rejected'])->default('Pending');
            $table->foreignId('staff_id')->nullable()->constrained('users')->onDelete('set null'); // Assigned Staff
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
