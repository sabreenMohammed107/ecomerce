<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\SizeResource;
use App\Http\Resources\DetailsResource;
class CategoryResource extends JsonResource
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
            "ar_name" => $this->ar_name !==null ? $this->ar_name : '',
            "en_name" => $this->en_name !==null ? $this->en_name : '',

            "ar_description" => $this->ar_description !==null ? strip_tags($this->ar_description) : '' ,
            "en_description" => $this->en_description !==null ? strip_tags($this->en_description) : '' ,
            "images"=> asset('uploads/attachment/' . $this->images['img']) ?? '',

            // "images"=> ProImageResource::make($this->images),
            // ProImageResource::collection($this->images),


            ];
    }

}
