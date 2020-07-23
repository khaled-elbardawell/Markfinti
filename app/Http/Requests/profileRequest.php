<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class profileRequest extends FormRequest
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
         'fname'      => 'required|string|alpha|min:4|max:10',
         'lname'      => 'required|string|alpha|min:4|max:10',
         'phone'      => 'required|string|min:5|max:20|unique:users,phone,'.$this -> id,
         'photo'      => 'mimes:jpg,jpeg,png|max:200',
         'email'      => 'required|min:6|max:20|email|unique:users,email,'.$this -> id,
         'address'    => 'required|string|max:20',
     ];

    }

}
