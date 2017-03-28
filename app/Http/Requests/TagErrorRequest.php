<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class TagErrorRequest extends BaseFormRequest
{
    public function messages()
    {
        return [
            'message.max' => '错误信息必须少于400字'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'error' => 'required|boolean',
            'message' => 'max:400'
        ];
    }
}
