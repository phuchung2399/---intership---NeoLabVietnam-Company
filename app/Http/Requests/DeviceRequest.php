<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeviceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'device_name' => 'required',
            'label_name' => 'required|unique:devices,label_name,' . $this->id,
            // 'description'  => '',
            // 'firmware_version'   =>'',
            // 'sn_imei' => '',
            // 'note' => '',
            'device_status' => 'required',
            'available' => 'required',
            'category_id'  => 'required'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'device_name.required' => 'Device name field is required',
            'label_name.required' => 'Label name field is required',
            'label_name.unique' => 'Label name must be unique',
            // 'description'  => '',
            // 'firmware_version'   =>'',
            // 'sn_imei' => '',
            // 'note' => '',
            'device_status.required' => 'Device Status field is required',
            'available.required' => 'Available field is required',
            'category_id.required'  => 'Category id field is required',
        ];
    }
}
