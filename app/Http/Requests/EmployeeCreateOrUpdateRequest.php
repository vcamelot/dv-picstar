<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeCreateOrUpdateRequest extends FormRequest
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
            'name' => [
                'required',
                'min:3',
                'max:120',
            ],
            'position' => [
                'required',
                'in:manager,associate'
            ],
            'superior_id' => [
                'required_if:position,==,associate',
                'exists:employees'
            ],
            'start_date' => [
                'required',
                'date_format:Y-m-d',
                'before:now'
            ],
            'end_date' => [
                'date_format:Y-m-d',
                'after_or_equal:start_date',
                'before:now'
            ]
        ];
    }
}
