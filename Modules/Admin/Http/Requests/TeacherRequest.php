<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Teachers\Entities\Teacher;

class TeacherRequest extends FormRequest
{

    public function rules()
    {
        $teacher = Teacher::find($this->route('id'));
        return [
            'username' => 'required|unique:users,username,' . $teacher->user_id,
            'phone_number' => 'required|unique:users,phone_number,' . $teacher->user_id,
            'email' => 'required|email|unique:users,email,' . $teacher->user_id,
            'password' => 'required',
            'gender' => 'required',
            'name' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
            'subjects_counts' => 'required|integer',
            'description' => 'required',
            'transable' => 'required|boolean',
        ];
    }


    public function authorize()
    {
        return true;
    }
}
