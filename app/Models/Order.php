<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
     //
     protected $fillable = [
        'order_no',
    'user_id',
    'address',
    'payway',

    'order_date',
    'copoun',
    'subtotally',
    'tax',
    'delivery_cost',
    'total',
    'status',
    ];

    public function user(){
        return $this->belongsTo('App\Models\User','user_id');
      }

      public function items(){
        return $this->hasMany('App\Models\Order_item','order_id','id');
      }
}
