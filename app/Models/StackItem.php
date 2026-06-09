<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StackItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'profile_id',
        'technology_id',
        'proficiency_level',
        'sort_order',
    ];

    protected $casts = [
        'proficiency_level' => 'integer',
    ];

    // Relationship with Profile
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    // Relationship with Technology
    public function technology()
    {
        return $this->belongsTo(Technology::class);
    }
}
