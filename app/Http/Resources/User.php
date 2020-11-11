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
        $image = Image::where('id', $this->image_id)->first();
        return [
            'id' => $this->id,
            'name' => $this->name,
            'nickname' => $this->nickname,
            'birthday' => $this->birthday,
            'image_id' => $this->image_id,
            'image_name' => isset($image) ? $image->name : 'storage/images/default.png',
            // 'age' => Carbon::createFromDate($this->birthday)->age,
        ];
    }
}
