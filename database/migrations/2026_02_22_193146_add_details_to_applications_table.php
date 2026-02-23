<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->string('country')->nullable()->after('course_id');
            $table->string('university_name')->nullable()->after('country');
            $table->string('intake')->nullable()->after('university_name');
            $table->string('name')->nullable()->after('intake');
            $table->string('passport_number')->nullable()->after('name');
            $table->date('dob')->nullable()->after('passport_number');
            $table->string('phone')->nullable()->after('dob');
            $table->string('marital_status')->nullable()->after('phone');
            $table->text('address')->nullable()->after('marital_status');
            $table->string('nationality')->nullable()->after('address');
            $table->string('highest_qualification')->nullable()->after('nationality');
            $table->year('passing_year')->nullable()->after('highest_qualification');
            
            $table->string('tuition_fee_invoice')->nullable()->after('passing_year');
            $table->string('offer_letter')->nullable()->after('tuition_fee_invoice');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->dropColumn([
                'country', 'university_name', 'intake', 'name', 'passport_number', 'dob', 'phone', 
                'marital_status', 'address', 'nationality', 'highest_qualification', 'passing_year',
                'tuition_fee_invoice', 'offer_letter'
            ]);
        });
    }
};
