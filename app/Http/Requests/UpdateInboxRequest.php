<?php

namespace App\Http\Requests;

use App\Models\Inbox;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateInboxRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('inbox_edit');
    }

    public function rules()
    {
        return [
            'message' => [
                'required',
            ],
            'package_id' => [
                'required',
                'integer',
            ],
            'user_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
