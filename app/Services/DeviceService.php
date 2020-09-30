<?php

namespace App\Services;

use App\Repositories\DeviceRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DeviceService
{
    /**
     * @var $deviceRepository
     */
    protected $deviceRepository;

    /**
     * DeviceService constructor.
     * 
     * @param DeviceRepository $deviceRepository
     */
    public function __construct(DeviceRepository $deviceRepository)
    {
        $this->deviceRepository = $deviceRepository;
    }

    /**
     * Get all devices.
     * 
     * @return Array
     */
    public function getAll()
    {
        return $this->deviceRepository->getAll();
    }

    /**
     * Get device by id
     * 
     * @param $id
     * @return Object
     */
    public function getById($id)
    {
        return $this->deviceRepository->find($id);
    }

    public function getRelatedById($id)
    {
        $device = $this->getById($id);
        return $device->where('category_id', $device->category_id)->where('id', '!=', $device->id)->get();
    }

    /**
     * Validate device data.
     * 
     * Store to DB if there are no errors.
     * 
     * @param Request $request
     * @return Object
     */
    public function save(Request $request)
    {
        try {
            $device = $this->deviceRepository->create([
                'device_name' => $request->device_name,
                'label_name' => $request->label_name,
                'description' => isset($request->description) ? $request->description : null,
                'firmware_version' => isset($request->firmware_version) ? $request->firmware_version : null,
                'sn_imei' => isset($request->sn_imei) ? $request->sn_imei : null,
                'note' => isset($request->note) ? $request->note : null,
                'image' => isset($request->image) ? $this->uploadImg($request) : null,
                'device_status' => $request->device_status,
                'available' => $request->available,
                'category_id' => $request->category_id
            ]);

            return $device;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Update device data
     * Store to DB if there are no errors.
     * 
     * @param array $data
     * @param $id
     * @return Object
     */
    public function update(Request $request, $id)
    {
        return $this->deviceRepository->update($request, $id);
    }

    /**
     * Delete device by id
     * 
     * @param $id
     * @return Object
     */
    public function deleteById($id)
    {
        try {
            $device = $this->deviceRepository->find($id);
            if ($this->deleteImage($device->image)) {
                return $this->deviceRepository->delete($id);
            } else
                return $this->deviceRepository->delete($id);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Update image for deivce by id
     * 
     * @param Request $request
     * @param $id
     * @return String
     */
    public function uploadDeviceImg(Request $request, $id)
    {
        try {
            $device = $this->deviceRepository->find($id);

            if ($this->deleteImage($device->image)) {

                $device->image = $this->uploadImg($request);

                $device->save();
            }

            return $device;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function uploadImg(Request $request)
    {
        try {
            $file = $request->file('image');

            $path = Storage::putFile('public/upload/device-images', $file);

            return $path;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function deleteImage($path)
    {
        try {
            if (Storage::exists($path)) {
                Storage::delete($path);
                return true;
            }
            return true;
        } catch (\Throwable $th) {
            throw $th;
            return false;
        }
    }
}
