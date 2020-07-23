<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class mangerRequest extends FormRequest
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

        if($this->has('id') && $this->has('password')){
           if ($this->input('password') == ''){
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

        return [
            'fname'      => 'required|string|alpha|min:4|max:10',
            'lname'      => 'required|string|alpha|min:4|max:10',
            'phone'      => 'required|string|min:5|max:20|unique:users,phone,'.$this -> id,
            'photo'      => 'mimes:jpg,jpeg,png|max:200',
            'password'   => 'required_without:id|min:7|max:16',
            'email'      => 'required|min:6|max:20|email|unique:users,email,'.$this -> id,
            'address'    => 'required|string|max:20',
            'position'   =>  'required_without:id|string|max:20',
            'identity'   =>  'required_without:id|string|max:20',

        ];
    }

    public function messages()
    {
        return [
           'identity.required_without' => 'The identity field is required',
           'position.required_without' => 'The position field is required',
           'password.required_without' => 'The password field is required',
           'password.min' => 'The password must be at least 7 characters and  not be greater than 16 characters.',
           'password.max' => 'The password must be at least 7 characters and  not be greater than 16 characters.',
        ];
    }
}
