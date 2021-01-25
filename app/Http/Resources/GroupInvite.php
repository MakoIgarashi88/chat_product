<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GroupInvite extends JsonResource
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
            'group_id' => $this->group->id,
            'group_name' => $this->group->name,
            'group_detail' => $this->group->detail,
            'group_image_name' => isset($this->group->image) ? '/' . $this->group->image->name : '/storage/images/default.png',
            'user_id' => $this->user->id,
            'nickname' => $this->user->nickname,
        ];
    }
}
