<?php

namespace App\Http\Requests\MyInfo;

use Illuminate\Foundation\Http\FormRequest;

class ADExperiencesRequest extends FormRequest
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
           'content' => 'required'
        ];
    }
    public function messages() 
    {
        return [
            'name.required' => 'Không để trống tên',
            'content.required' => 'Không để trống nội dung'
        ];
    }
}
