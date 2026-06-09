<?php

namespace App\Models;

use Database\Factories\ExperienceFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    /** @use HasFactory<ExperienceFactory> */
    use HasFactory;

    // app/Models/Experience.php
    protected $fillable = [
        'profile_id',
        'company_name',
        'position',
        'location',
        'start_date',
        'end_date',
        'is_current',
        'responsibility',
        'sort_order',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_current' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
