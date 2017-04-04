<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DirtyWaterRequest extends BaseFormRequest
{
    public function messages()
    {
        return [
            'date.required' => '必须填写月份',
            'date.date' => '月份必须是时间格式',
            'mount.required' => '必须填写厌氧处理系统废水量',
            'mount.numeric' => '厌氧处理系统废水量必须是数字',
            'incod.required' => '必须填写厌氧处理系统进水口COD',
            'incod.numeric' => '厌氧处理系统进水口COD必须是数字',
            'outcod.required' => '必须填写厌氧处理系统出水口COD',
            'outcod.numeric' => '厌氧处理系统出水口COD必须是数字',
            'kgcod.required' => '必须填写污泥去除有机物',
            'kgcod.numeric' => '污泥去除有机物必须是数字',
            'kgch4.required' => '必须填写甲烷回收量',
            'kgch4.numeric' => '甲烷回收量必须是数字',
            'jwxzyz.required' => '必须填写甲烷修正因子',
            'jwxzyz.numeric' => '甲烷修正因子必须是数字',
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
            'date' => 'required|date',
            'mount' => 'required|numeric',
            'incod' => 'required|numeric',
            'outcod' => 'required|numeric',
            'kgcod' => 'required|numeric',
            'kgch4' => 'required|numeric',
            'jwxzyz' => 'required|numeric'
        ];
    }
}
