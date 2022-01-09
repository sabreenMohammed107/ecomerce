<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    use HasFactory;
    protected $fillable = [
        'promo_key',
        'expired_date',
        'category_id',
        'product_id',
        'status',
        'value',
    ];

    public function category(){
        return $this->belongsTo('App\Models\Category','category_id');
      }

      public function product(){
        return $this->belongsTo('App\Models\Product','product_id');
      }
}
