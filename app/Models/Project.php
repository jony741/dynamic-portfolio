<?php

namespace App\Models;

use Database\Factories\ProjectFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /** @use HasFactory<ProjectFactory> */
    use HasFactory;

    // app/Models/Project.php
    protected $fillable = [
        'profile_id',
        'name',
        'description',
        'live_url',
        'repo_url',
        'thumbnail_url',
        'is_featured',
        'sort_order',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    // many-to-many relationship through project_technologies
    public function technologies()
    {
        return $this->belongsToMany(
            Technology::class,
            'project_technologies'
        )->withPivot('sort_order')->orderByPivot('sort_order');
    }
}
