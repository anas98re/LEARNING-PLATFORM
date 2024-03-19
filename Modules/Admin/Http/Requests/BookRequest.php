<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class bookRequest extends FormRequest
{

    public function rules()
    {
        return [
            'title' => 'required',
            'pdf_path' => 'required|mimes:application/pdf',
            'website_library_id' => 'required|exists:website_library,id',
            'author_name' => 'required',
            'transable' => 'required|boolean'
        ];
    }

    public function authorize()
    {
        return true;
    }
}
