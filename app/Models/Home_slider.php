<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Home_slider extends Model
{
    use HasFactory;
    protected $fillable = [
        'en_title',
    'ar_title',
    'image',
    'en_text',
    'ar_text',
    'product_id',
    'category_id',
    'order',
    'active',
    ];

    public function category(){
        return $this->belongsTo('App\Models\Category','category_id');
      }

      public function product(){
        return $this->belongsTo('App\Models\Product','product_id');
      }
}
