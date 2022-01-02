<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_size extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'size_id',

    ];
    public function size(){
        return $this->belongsTo('App\Models\Size','size_id');
    }
}
