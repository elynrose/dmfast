<?php

namespace App\Http\Requests;

use App\Models\Page;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePageRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('page_create');
    }

    public function rules()
    {
        return [
            'full_name' => [
                'string',
                'required',
            ],
            'bio' => [
                'required',
            ],
            'short_url' => [
                'string',
                'required',
                'unique:pages',
            ],
            'packages.*' => [
                'integer',
            ],
            'packages' => [
                'required',
                'array',
            ],
        ];
    }
}
