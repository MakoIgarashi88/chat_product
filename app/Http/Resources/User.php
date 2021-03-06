<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;
use App\Image;

class User extends JsonResource
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
        ];
    }
}
