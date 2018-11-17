<?php

namespace App\Http\Requests\ADUsers;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class ADUsersRequest extends FormRequest
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
        $unique = (strpos($route->getName(),"add")) ? "users" : "users,id,".$this->id;
        return [
            'username' => "{$required}|min:3|max:60|unique:{$unique}",
            'password' => "{$required}", 
            'vgroup' => 'required',  
            'fullname' => 'required',   
            'email' => "required|email|unique:{$unique}"
        ];
    }
    public function messages() 
    {
        return [
            'required'=>':attribute Không được để trống',
            'min'=>':attribute tối thiểu :min kí tự',
            'max'=>':attribute tối đa :max kí tự',
            'email'=>':attribute phải đúng định dạng email',
            'unique'=>':attribute đã tồn tại',
        ];
    }
}
