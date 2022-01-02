<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
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


            'user_id'=> UserResource::make($this->user),
            'product_id' => ProductResource::make($this->product),
            'quantity'=> $this->quantity !==null ? $this->quantity : '',

            ];
    }
}
