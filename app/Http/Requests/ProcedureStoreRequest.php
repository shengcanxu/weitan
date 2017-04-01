<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProcedureStoreRequest extends BaseFormRequest
{
    public function messages()
    {
        return [
            'storedate.required' => '必须填写入厂时间',
            'storedate.date' => '入厂时间必须是时间格式',
            'type.required' => '必须填写能源类型',
            'batchno.required' => '必须填写批次号',
            'batchno.unique' => '批次号不能重复',
            'number.required' => '必须填写入厂数量',
            'number.numeric' => '入厂数量必须是数字'
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
            'storedate' => 'required|date',
            'type' => 'required',
            'batchno' => 'required|unique:procedure_stores',
            'number' => 'required|numeric'
        ];
    }
}
