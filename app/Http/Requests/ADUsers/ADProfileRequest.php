<?php

namespace App\Http\Requests\ADUsers;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class ADProfileRequest extends FormRequest
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
    public function rules(Route $route)
    {   
        $required = (strpos($route->getName(),"add")) ? "required" : "";
        return [
            'password' => "{$required}", 
            'fullname' => 'required'  
        ];
    }
    public function messages() 
    {
        return [
            'required'=>':attribute Không được để trống'
        ];
    }
}
