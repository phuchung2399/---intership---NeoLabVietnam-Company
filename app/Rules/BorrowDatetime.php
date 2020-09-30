<?php

namespace App\Rules;

use App\Device;
use Illuminate\Contracts\Validation\Rule;

class BorrowDatetime implements Rule
{
    protected $device;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($device_id)
    {
        $this->device = Device::findOrFail($device_id);
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if ($this->device->available) {
            return true;
        } else {

            $device_end_date_existing = date($this->device->borrows()->orderBy('created_at', 'DESC')->first()->end_date);

            $device_start_date_input = date('Y-m-d H:i:s', strtotime($value));

            if ($device_end_date_existing < $device_start_date_input) {
                return true;
            }
            return  false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The device date field invalid';
    }
}
