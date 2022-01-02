<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'ar_name',
        'en_name',
        'en_description',
        'ar_description',
        'order',

    ];

    public function images()
    {
        return $this->morphToMany(Image::class, 'taggable');
    }


}
