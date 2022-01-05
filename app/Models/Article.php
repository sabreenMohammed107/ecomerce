<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Support\Str;
class Article extends Model
{
    use HasFactory;
    protected $fillable = ['img','ar_title', 'ar_text','en_title', 'en_text'];

    public function tag()
    {
        return $this->belongsToMany(Tag::class, 'article_tags');
    }

    public function getSlugAttribute(): string
    {
        if( LaravelLocalization::getCurrentLocale() === "en"){
            return str_slug($this->en_title);

        }else{
            return urlencode($this->ar_title);
            // return Str::slug($this->ar_title)==""?strtolower(urlencode($this->ar_title)):Str::slug($this->ar_title);

        }
    }




    public function getUrlAttribute(): string
    {
        // return action('App\Http\Controllers\Web\BlogsController', [$this->id, $this->slug]);
        return $this->slug;
    }
}
