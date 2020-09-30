<?php

namespace App\Repositories;

use App\Device;

class DeviceRepository
{
    /**
     * @var device
     */
    protected $device;

    /**
     * DeviceRepository constructor.
     * 
     * @param Device $device
     */
    public function __construct(Device $device)
    {
        $this->device = $device;
    }

    /**
     * Get all devices.
     * 
     * @return Category $category
     */
    public function getAll()
    {
        return $this->device->with('category')->get();
    }

    /**
     * Get device by id
     * 
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->device->findOrFail($id)->loadMissing('category');
    }

    /**
     * Save device
     * 
     * @param $data
     * @return mixin    
     */
    public function create($data)
    {
        return $this->device->create($data);
    }

    /**
     * Update device
     * 
     * @param $data
     * @return mixin
     */
    public function update($data, $id)
    {
        $device = $this->device->findOrFail($id);

        $device->device_name = $data['device_name'];
        $device->label_name = $data['label_name'];
        $device->description = $data['description'];
        $device->firmware_version = $data['firmware_version'];
        $device->sn_imei = $data['sn_imei'];
        $device->device_status = $data['device_status'];
        $device->available = $data['available'];
        $device->note = $data['note'];
        $device->category_id = $data['category_id'];

        $device->update();

        return $device->loadMissing('category');
    }

    /**
     * Delete device
     * 
     * @param $id 
     * @return mixin
     */
    public function delete($id)
    {
        $device = $this->device->findOrFail($id);

        $device->delete();

        return $device;
    }

     /**
     * Restore Device
     * 
     * @param $id
     * @return mixin
     */
    public function restore($id)
    {
        $device = $this->device->withTrashed()->find($id);
         $device->restore(); 
        return $device; 
    }
}
