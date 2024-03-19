<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Students\Entities\Student;

class StudentsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $student = Student::find($this->route('id'));
        return [
            'username' => 'required|unique:users,username,' . $student->user_id,
            'phone_number' => 'required|unique:users,phone_number,' . $student->user_id,
            'email' => 'required|email|unique:users,email,' . $student->user_id,
            'password' => 'required',
            'gender' => 'required',
            'name' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
            'class' => 'required',
            'school' => 'required',
            'weaknesses_subjects' => 'required',
            'strong_subjects' => 'required',
            'father_name' => 'required',
            'mother_name' => 'required',
            'birthday' => 'required|date_format:Y-m-d',
            'address' => 'required',
            'city' => 'required',
            'student_languages' => 'required|array|min:1',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
