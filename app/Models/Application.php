<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'course_id',
        'status',
        'staff_id',
        'country',
        'university_name',
        'intake',
        'name',
        'passport_number',
        'dob',
        'phone',
        'marital_status',
        'address',
        'nationality',
        'highest_qualification',
        'passing_year',
        'tuition_fee_invoice',
        'offer_letter',
    ];

    public function user() // Student
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function staff()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }

    public function documents()
    {
        return $this->hasMany(ApplicationDocument::class);
    }

    public function getRequiredDocuments()
    {
        $requiredDocuments = [
            'Passport', 'Passport-size Photo', 'Intermediate Certificate',
            'Intermediate Result Card', 'Matriculation Certificate', 'Matriculation Result Card',
            'Medium of Instruction (MOI)', 'CV', 'Experience Letter', 'Supporting Document 1',
            'Supporting Document 2', 'Supporting Document 3', 'Supporting Document 4',
            'Supporting Document 5'
        ];

        // Conditional documents based on course level
        $courseLevel = strtolower($this->course->level);
        
        if (str_contains($courseLevel, 'master') || str_contains($courseLevel, 'postgraduate')) {
            array_splice($requiredDocuments, 2, 0, ["Bachelor's Degree", "Bachelor's Transcript"]);
        } elseif (str_contains($courseLevel, 'bachelor') || str_contains($courseLevel, 'undergraduate')) {
            // Already handled in base list
        } else {
            // Default: include both if not clearly undergraduate
            array_splice($requiredDocuments, 2, 0, ["Master's Degree", "Master's Transcript", "Bachelor's Degree", "Bachelor's Transcript"]);
        }

        return $requiredDocuments;
    }
}
