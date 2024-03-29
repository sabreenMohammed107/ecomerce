<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\SizeResource;
use App\Http\Resources\DetailsResource;
class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $posts = $this->images->pluck('img');
foreach($posts AS $index => $image){
  $posts[$index] = url("/uploads/attachment/".$image);
}
        return [
            "item_id" => $this->id,
            "ar_name" => $this->ar_name !==null ? $this->ar_name : '',
            "en_name" => $this->ar_name !==null ? $this->en_name : '',
            "ar_description" => $this->ar_description !==null ? strip_tags($this->ar_description) : '' ,
            "en_description" => $this->en_description !==null ? strip_tags($this->en_description) : '' ,
            "price" =>number_format((float) $this->price, 1)  ?? '',
            "price_after_discount" => number_format((float) $this->price_after_discount, 1)  ?? '',
            "discount" => number_format((float) $this->discount, 1)  ?? '',
            'category'=>CategoryResource::make($this->category),
               "rate"=> $this->avg_rate  ,
            "sizes"=> SizeResource::collection($this->sizes),
            // 'review'=>ReviewResource::collection($this->review),
            "details"=> DetailsResource::collection($this->details),
            "color"=>ColorResource::collection($this->color),
            //"images"=> ProImageResource::collection($this->images)->all(),
            "images"=>$posts,


            ];
    }

}
