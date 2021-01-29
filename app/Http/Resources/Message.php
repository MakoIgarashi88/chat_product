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
        $is_myself = $this->user_id == \Auth::user()->id ? true : false;
        return [
            'id' => $this->id,
            'body' => $this->body,
            'is_myself' => $is_myself,
            'nickname' => $this->user->nickname,
            'user_id' => $this->user->id,
            'image' => '/' . $this->user->image->name,
            'created_at' => Carbon::parse($this->created_at)->format('m/d G:i'),
        ];
    }
}
