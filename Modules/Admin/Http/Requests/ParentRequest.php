<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Parents\Entities\Guardian;

class parentRequest extends FormRequest
{

    public function rules()
    {
        $Guardian = Guardian::find($this->route('id'));
        return [
            'username' => 'required|unique:users,username,' . $Guardian->user_id,
            'phone_number' => 'required|unique:users,phone_number,' . $Guardian->user_id,
            'email' => 'required|email|unique:users,email,' . $Guardian->user_id,
            'password' => 'required',
            'name' => 'required',
            'gender' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048'
        ];
    }


    public function authorize()
    {
        return true;
    }
}
