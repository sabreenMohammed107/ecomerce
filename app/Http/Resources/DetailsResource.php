<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DetailsResource extends JsonResource
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

            "ar-name" => $this->key_ar_name ?? '',
            "en-name" => $this->key_en_name ?? '',

            'ar-desc'=>strip_tags($this->ar_value_text) ?? '',
            'en-desc'=>strip_tags($this->en_value_text) ?? '',

            ];
    }
}
