<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ElectricInnerUsageRequest extends BaseFormRequest
{
    public function messages()
    {
        return [
            'month.required' => '必须填写月份',
            'month.date' => '月份必须是时间格式',
            'producetype.required' => '必须填写生产工序',
            'devicename.required' => '必须填写电表名称',
            'lastnumber.required' => '必须填写上月行码',
            'lastnumber.numeric' => '上月行码必须是数字',
            'currentnumber.required' => '必须填写本月行码',
            'currentnumber.numeric' => '本月行码必须是数字',
            'times.required' => '必须填写倍率',
            'times.numeric' => '倍率必须是数字',
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
            'producetype' => 'required',
            'devicename' => 'required',
            'lastnumber' => 'required|numeric',
            'currentnumber' => 'required|numeric',
            'times' => 'required|numeric'
        ];
    }
}
