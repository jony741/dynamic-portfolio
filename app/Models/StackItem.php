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

    public function technology()
    {
        return $this->belongsTo(Technology::class);
    }


}
