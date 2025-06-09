<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Bookmark;

class Category extends Model {
    use HasFactory;

    protected $fillable = ['user_id', 'name'];

    public function bookmarks() {
        return $this->hasMany(Bookmark::class);
    }
}
