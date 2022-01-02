<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_item extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'cart_id',
        'product_id',
        'price',
        'total',
        'quantity',
    ];

    public function cart(){
        return $this->belongsTo('App\Models\Cart','cart_id');
      }

      public function product(){
        return $this->belongsTo('App\Models\Product','product_id');
      }
}
