<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
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

            "rate_no" =>(integer)$this->rate_no,
            'comment' => $this->ar_comment ?? '',
            "creat_date" => Carbon::parse($this->created_at),
            "user" => new UserResource($this->user),

        ];
    }
}
