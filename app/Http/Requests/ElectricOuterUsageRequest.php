<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ElectricOuterUsageRequest extends BaseFormRequest
{
    public function messages()
    {
        return [
            'month.required' => '必须填写月份',
            'month.date' => '月份必须是时间格式',
            'datasource.required' => '必须填写数据来源',
            'usagenumber.required' => '必须填写用量',
            'usagenumber.numeric' => '用量必须是数字',
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
            'month' => 'required|date',
            'datasource' => 'required',
            'usagenumber' => 'required|numeric',
        ];
    }
}
