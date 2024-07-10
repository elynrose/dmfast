<?php

namespace App\Http\Requests;

use App\Models\TotalCredit;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTotalCreditRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('total_credit_create');
    }

    public function rules()
    {
        return [
            'stripe_transaction' => [
                'string',
                'required',
                'unique:total_credits',
            ],
            'point' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
