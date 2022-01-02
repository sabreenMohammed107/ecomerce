<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $fillable = [
        'en_about_title',
    'ar_about_title',
    'en_about',
    'ar_about',
    'en_vision_title',
    'ar_vision_title',
    'en_vision',
    'ar_vision',
    'ar_mission_title',
    'en_mission_title',
    'ar_mission',
    'en_mission',

    ];
}
