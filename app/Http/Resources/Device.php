<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class Device extends JsonResource
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
            "device_name" => $this->device_name,
            "label_name" => $this->label_name,
            "description" => $this->description,
            "firmware_version" => $this->firmware_version,
            "sn_imei" => $this->sn_imei,
            "device_status" => $this->device_status,
            "available" => $this->available,
            "image" => Storage::exists($this->image) ? env('APP_URL') . ":8000" . Storage::url($this->image) : null,
            "note" => $this->note,
            "category" => new Category($this->whenLoaded('category')),
            // "related_device" => $this->where('category_id', $this->category_id)->where('id', '!=', $this->id)->get(),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
