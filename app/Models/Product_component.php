<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_component extends Model
{
    use HasFactory;


    protected $primaryKey = 'id';
    protected $fillable = [
        'product_id',
        'key_ar_name',
        'key_en_name',
        'ar_value_text',
        'en_value_text',
    ];
}
