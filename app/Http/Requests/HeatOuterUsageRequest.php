<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HeatOuterUsageRequest extends BaseFormRequest
{
    public function messages()
    {
        return [
            'month.required' => '必须填写月份',
            'month.date' => '月份必须是时间格式',
            'datasource.required' => '必须填写数据来源',
            'temperature.required' => '必须填写温度',
            'temperature.numeric' => '温度必须是数字',
            'pressure.required' => '必须填写压力',
            'pressure.numeric' => '压力必须是数字',
            'heatquality.required' => '必须填写蒸汽质量',
            'heatquality.numeric' => '蒸汽质量必须是数字',
            'enthalpy.numeric' => '焓值必须是数字',
            'heatusage.numeric' => '供热量必须是数字'
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
            'temperature' => 'required|numeric',
            'pressure' => 'required|numeric',
            'heatquality' => 'required|numeric',
            'enthalpy' => 'numeric',
            'heatusage' => 'numeric'
        ];
    }
}
