<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

use App\Http\Resources\User as UserResource;

class BoardMessage extends JsonResource
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
            'user_id' => $this->user_id,
            'board_id' => $this->board_id,
            'body' => $this->body,
            'user' => new UserResource($this->user),
            // 'created_at' => Carbon::parse($this->created_at)->format('m/d h:i'),
        ];
    }
}
