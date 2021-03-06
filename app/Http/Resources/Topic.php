<?php

namespace App\Http\Resources;
use App\Http\Resources\Tag as TagResource;

use Illuminate\Http\Resources\Json\JsonResource;

class Topic extends JsonResource
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
            'detail' => $this->detail,
            'image_id' => $this->image_id,
            'image_name' => isset($this->image) ? '/' . $this->image->name : '/storage/images/default.png',
            'tags' => json_decode($this->tags),
            'message' => $this->message,
            // 'tags' => TagResource::collection($this->tags),
        ];
    }
}
