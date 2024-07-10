<?php

namespace App\Http\Requests;

use App\Models\PaymentSetting;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePaymentSettingRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('payment_setting_edit');
    }

    public function rules()
    {
        return [
            'user_id' => [
                'required',
                'integer',
            ],
            'method_id' => [
                'required',
                'integer',
            ],
            'email' => [
                'string',
                'nullable',
            ],
            'phone' => [
                'string',
                'nullable',
            ],
            'routing' => [
                'string',
                'nullable',
            ],
            'account' => [
                'string',
                'nullable',
            ],
        ];
    }
}
