<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\SizeResource;
use App\Http\Resources\DetailsResource;
use App\Models\Product;

class HomeSliderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        return [
            "item_id" => $this->id,
            "en_title" => $this->en_title !==null ? $this->en_title : '',
            "ar_title" => $this->ar_title !==null ? $this->ar_title : '',
            "en_text" => $this->en_text !==null ? $this->en_text : '' ,
            "ar_text" => $this->ar_text !==null ? $this->ar_text : '' ,

            "order" => $this->order ?? '',
            "active" => $this->active ?? '',
            "product"=> ProductResource::make($this->product),
            'category'=>CategoryResource::make($this->category),

            "image"=> asset('uploads/home_sliders/' . $this->img) ?? '',


            ];
    }

}
