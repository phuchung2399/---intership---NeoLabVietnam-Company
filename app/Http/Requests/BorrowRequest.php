<?php

namespace App\Http\Requests;

use App\Rules\BorrowDatetime;
use Illuminate\Foundation\Http\FormRequest;

class BorrowRequest extends FormRequest
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
            'project_name' => 'required',
            'device_id' => 'required',
            'start_date' => ['required','date','after_or_equal:now', new BorrowDatetime($this->device_id)],
            'end_date' => 'required|date|after:start_date',
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
            'project_name.required' => 'Project name field is required',
        ];
    }
}
