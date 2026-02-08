<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'university_id',
        'name',
        'level',
        'intake',
        'tuition_fee',
        'duration',
    ];

    public function university()
    {
        return $this->belongsTo(University::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}
