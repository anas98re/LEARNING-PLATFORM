<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class websiteLibraryRequest extends FormRequest
{

    public function rules()
    {
        return [
            'name' => 'required',
            'is_free' => 'required|boolean',
            'transable' => 'required|boolean'
        ];
    }


    public function authorize()
    {
        return true;
    }
}
