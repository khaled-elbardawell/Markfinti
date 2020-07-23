<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class projectRequest extends FormRequest
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
            'name'  => 'required|string|min:4|max:30',
            'discription'  => 'required|string|max:2000',
            'user_id' => 'required',
            'service_id' => 'required|array',
            'budget'    =>  'required|numeric',
            'start_date'      => 'required|date|before:end_date',
            'end_date'        => 'required|date|after:start_date',
            'progress'         => 'required',
            'manager_id'        => 'required'

        ];
    }
}
