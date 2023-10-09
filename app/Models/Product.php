<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ar_name',
        'en_name',
        'en_description',
        'ar_description',
        'price',
        'discount',
        'price_after_discount',
        'category_id',
        'status',
    ];


    public function images()
    {
        return $this->morphToMany(Image::class, 'taggable');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function color()
    {
    return $this->belongsToMany('App\Models\Color', 'product_colors', 'product_id',
   'color_id');
    }
    public function users(){
        return $this->belongsToMany('App\User','product_rates');
      }


      public function review(){
        return $this->hasMany('App\Models\Product_rate');
      }

      public function sizes()
      {
      return $this->belongsToMany('App\Models\Size', 'product_sizes', 'product_id',
     'size_id');
       }


    public function details()
    {
        return $this->hasMany('App\Models\Product_component');
    }
    protected $appends = ['avg_rate'];

    public function getAvgRateAttribute()
{
    return round($this->review()->avg('rate_no'),1);
}
    public function avgRating()
{
    return round($this->review()->avg('rate_no'),1);
}
public function verifyedReviews() {
    // return "ff";
    return $this->review()->pluck('comment')->toArray();

}
}
