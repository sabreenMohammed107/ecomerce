<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'product_size',
        'product_color',
        'quantity',
        'status',
    ];

    public function user(){
        return $this->belongsTo('App\Models\User','user_id');
      }

      public function product(){
        return $this->belongsTo('App\Models\Product','product_id');
      }

      public function size(){
        return $this->belongsTo('App\Models\Product_size','product_size');
      }

      public function color(){
        return $this->belongsTo('App\Models\Product_color','product_color');
      }

      public function items(){
        return $this->hasMany('App\Models\Cart_item','cart_id','id');
      }
}
