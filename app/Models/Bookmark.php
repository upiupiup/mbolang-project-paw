<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Destination;
use App\Models\Category;

class Bookmark extends Model {
    use HasFactory;

    protected $fillable = ['user_id', 'destination_id', 'category_id'];

    public function destination() {
        return $this->belongsTo(Destination::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
