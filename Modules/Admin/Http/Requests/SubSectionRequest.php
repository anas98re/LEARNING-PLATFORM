<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubSectionRequest extends FormRequest
{

    public function rules()
    {
        return [
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'section_id' => 'required',
            'transable' => 'required|boolean'
        ];
    }


    public function authorize()
    {
        return true;
    }
}
