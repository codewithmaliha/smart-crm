<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class University extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'country',
        'website',
        'description',
        'logo_path',
    ];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
