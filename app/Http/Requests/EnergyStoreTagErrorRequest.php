<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class EnergyStoreTagErrorRequest extends FormRequest
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
            'id' => 'required|integer|min:1',
            'error' => 'required|boolean',
            'message' => 'max:400'
        ];
    }

    protected function formatErrors(Validator $validator)
    {
        $errors =  parent::formatErrors($validator);
        return ['status'=>'validate_fail', 'errors'=>$errors];
    }
}
