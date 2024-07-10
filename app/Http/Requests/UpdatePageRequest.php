<?php

namespace App\Http\Requests;

use App\Models\Page;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePageRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('page_edit');
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
                'unique:pages,short_url,' . request()->route('page')->id,
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
