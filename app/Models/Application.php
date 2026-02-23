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
}
