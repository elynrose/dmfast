<?php

namespace App\Http\Requests;

use App\Models\CreditSetting;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCreditSettingRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('credit_setting_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:credit_settings,id',
        ];
    }
}
