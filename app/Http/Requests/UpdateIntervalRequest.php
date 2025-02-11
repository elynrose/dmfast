<?php

namespace App\Http\Requests;

use App\Models\Interval;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateIntervalRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('interval_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'hours' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
