<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnergyStoreAnalysisRequest extends BaseFormRequest
{
    public function messages()
    {
        return [
            'energy_store_id.required' => '必须填写入厂数据ID',
            'energy_store_id.integer' => '入厂数据ID必须是数字',
            'device.required' => '必须填写设备',
            'method.required' => '必须填写分析方法',
            'dwfrl.required' => '必须填写低位发热量',
            'dwrlhtl.required' => '必须填写单位热值含碳量',
            'tyhl.required' => '必须填写碳氧化率',
            'dwfrl.numeric' => '低位发热量必须是数字',
            'dwrlhtl.numeric' => '单位热值含碳量必须是数字',
            'tyhl.numeric' => '碳氧化率必须是数字',
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
            'energy_store_id' => 'required|integer',
            'device' => 'required',
            'method' => 'required',
            'dwfrl' => 'required|numeric',
            'dwrlhtl' => 'required|numeric',
            'tyhl' => 'required|numeric'
        ];
    }

}
