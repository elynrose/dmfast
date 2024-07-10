<?php

namespace App\Http\Requests;

use App\Models\CreditSetting;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCreditSettingRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('credit_setting_edit');
    }

    public function rules()
    {
        return [
            'credit' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'amount' => [
                'required',
            ],
        ];
    }
}
