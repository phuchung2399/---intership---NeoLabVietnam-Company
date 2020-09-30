<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Borrow extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            "id" => $this->id,
            "project_name" => $this->project_name,
            "request_date" => $this->request_date,
            "status" => $this->status,
            "note" => $this->note,
            "user" => new User($this->user),
            "device" => new Device($this->device),
            "start_date" => $this->start_date,
            "end_date" => $this->end_date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
