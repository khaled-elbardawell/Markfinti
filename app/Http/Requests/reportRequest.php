<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class reportRequest extends FormRequest
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
             'type_id' => 'required|numeric',
             'added_date'  => 'required|date|max:14',
             'fileupload'  => 'required|mimes:pdf,docx|max:100',
        ];
    }
}
