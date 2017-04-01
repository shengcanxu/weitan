<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TypeGetRequest extends BaseFormRequest
{

    public function messages()
    {
        return [
            'type.string' => '入厂时间必须是文本格式',
            'from.date' => '开始时间必须是时间格式',
            'to.date' => '结束时间必须是时间格式',
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
            'type' => 'string',
            'from' => 'date',
            'to' => 'date'
        ];
    }

}
