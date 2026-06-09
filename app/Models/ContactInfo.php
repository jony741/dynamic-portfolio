<?php

namespace App\Models;

use Database\Factories\ContactInfoFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactInfo extends Model
{
    /** @use HasFactory<ContactInfoFactory> */
    use HasFactory;

    // app/Models/ContactInfo.php
    protected $fillable = [
        'profile_id',
        'type',
        'label',
        'value',
        'icon_slug',
        'is_visible',
        'sort_order',
    ];

    protected $casts = [
        'is_visible' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
