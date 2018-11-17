<?php

namespace App\Http\Requests\MyInfo;

use Illuminate\Foundation\Http\FormRequest;

class ADSkillsRequest extends FormRequest
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
           'name' => 'required',
           'value' => 'required'
        ];
    }
    public function messages() 
    {
        return [
            'required'=>':attribute Không được để trống'
        ];
    }
}
