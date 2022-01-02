<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_rate extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'user_id',
        'rate_no',
        'ar_comment',
        'en_comment',
        'show'

    ];
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }
}
