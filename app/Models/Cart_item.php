<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart_item extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_id',
        'product_id',
        'product_size',
        'product_color',
        'quantity',
        'price',
    ];

    public function cart(){
        return $this->belongsTo('App\Models\Cart','cart_id');
      }

      public function product(){
        return $this->belongsTo('App\Models\Product','product_id');
      }

}
