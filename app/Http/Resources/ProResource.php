<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProResource extends JsonResource
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


            'name'=>$this->name !==null ? $this->name : '',
            'description'=>$this->description ?? '',
            'price'=>$this->price ?? '',
            'discount'=>$this->discount ?? '',
            'price_after_discount'=>$this->price_after_discount ?? '',

            ];
    }
}
