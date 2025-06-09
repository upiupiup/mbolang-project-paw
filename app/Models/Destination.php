<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    protected $fillable = [
        'category',
        'name',
        'slug',
        'image',
        'description',
        'location',
        'contact_person',
        'gmaps_link',
    ];
}
