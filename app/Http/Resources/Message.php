<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class Message extends JsonResource
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
            'id' => $this->id,
            'is_myself' => $this->user_id == \Auth::user()->id ? true : false,
            'user_id' => $this->user_id,
            'body' => $this->body,
            'created_at' => Carbon::parse($this->created_at)->format('m/d h:i'),
        ];
    }
}
