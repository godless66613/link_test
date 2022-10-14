<?php

namespace App\Http\Requests\Link;

use Illuminate\Foundation\Http\FormRequest;

class LinkCreateRequest extends FormRequest
{

    public function rules()
    {
        return [
            'link'              => 'required|url',
            'transfer_limit'    => 'nullable|integer',
            'lifetime'          => 'required|integer|min:1|max:24',
        ];
    }

}
