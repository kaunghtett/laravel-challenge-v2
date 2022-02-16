<?php

namespace App\Http\Requests;

use App\Traits\ApiResponser;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    use ApiResponser;
    /**
    * Determine if the user is authorized to make this request.
    *
    * @return bool
    */
  
    /**
    * Get the validation rules that apply to the request.
    *
    * @return array
    */
    public function rules()
    {
        return [
            //
            'email' => 'required|email|min:6|max:255',
            'password' => 'required|min:8'
        ];
    }
      
    public function messages()
    {
        return [
            'email.required' => 'Email is required',
            'password.required' => 'Password is required',
        ];
    }
    
   
}
