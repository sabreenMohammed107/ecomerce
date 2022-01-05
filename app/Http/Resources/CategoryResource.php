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
            "ar-name" => $this->ar_name !==null ? $this->ar_name : '',
            "en-name" => $this->en_name !==null ? $this->en_name : '',

            "ar-description" => $this->ar_description !==null ? strip_tags($this->ar_description) : '' ,
            "en-description" => $this->en_description !==null ? strip_tags($this->en_description) : '' ,

            "images"=> ProImageResource::collection($this->images),


            ];
    }

}
