<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ApplicationDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_id',
        'name',
        'file_path',
        'status',
        'rejection_reason',
    ];

    public function application()
    {
        return $this->belongsTo(Application::class);
    }
}
