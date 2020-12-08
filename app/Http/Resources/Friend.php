<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use App\UserFriend;
use App\Image;


class Friend extends JsonResource
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
            'name' => $this->name,
            'detail' => ($this->detail) ? $this->detail : "",
            'nickname' => $this->nickname,
            'image_id' => $this->image_id,
            'image_name' => isset($this->image) ? '/' . $this->image->name : '/storage/images/default.png',
            'is_friend' => UserFriend::where('user_id', Auth::id())->where('friend_id', $this->id)->exists(),
        ];
    }

}
