<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnergyUsageRequest extends BaseFormRequest
{
    public function messages()
    {
        return [
            'usagedate.required' => '必须填写使用时间',
            'usagedate.date' => '使用时间必须是时间格式',
            'number.required' => '必须填写使用数量',
            'number.numeric' => '使用数量必须是数字',
            'store_id.required' => '必须填写入厂数据ID',
            'store_id.integer' => '入厂数据ID必须是数字'
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
            'usagedate' => 'required|date',
            'number' => 'required|numeric',
            'store_id' => 'required|integer'
        ];
    }
}
