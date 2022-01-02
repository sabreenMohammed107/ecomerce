<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $fillable = ['img','ar_title', 'ar_text','en_title', 'en_text'];

    public function tag()
    {
        return $this->belongsToMany(Tag::class, 'article_tags');
    }
}
