<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taggable extends Model
{
    use HasFactory;
    protected $fillable = [
        'image_id',
        'taggable_id',

    ];
    // public function products()
    // {
    //     return $this->morphedByMany(Product::class, 'taggable');
    // }

    // public function categories()
    // {
    //     return $this->morphedByMany(Category::class, 'taggable');
    // }

    public function image()
    {
        return $this->belongsTo(Image::class, 'img');
    }

}
