<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorites_product extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id',
    'product_id',

    ];

    public function product(){
        return $this->belongsTo('App\Models\Product','product_id');
    }
}
