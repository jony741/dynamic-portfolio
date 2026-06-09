<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'full_name',
        'designation',
        'short_description',
        'experience_summary',
        'avatar_url',
        'portfolio_github_folder_link',
        'linked_link',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
