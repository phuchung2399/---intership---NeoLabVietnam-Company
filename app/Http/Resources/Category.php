<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class Category extends JsonResource
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
            'id' => $this->id,
            'category_name' => $this->category_name,
            'description' => $this->description,
            'image' => Storage::exists($this->image) ? env('APP_URL') . ":8000" . Storage::url($this->image) : null,
            'devices' => Device::collection($this->whenLoaded('devices')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
