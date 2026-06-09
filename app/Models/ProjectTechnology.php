<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectTechnology extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectTechnologyFactory> */
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'project_id',
        'technology_id',
        'sort_order',
    ];
}
