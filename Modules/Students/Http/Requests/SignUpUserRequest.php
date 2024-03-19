<?php

namespace Modules\Students\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\App;

class SignUpUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'username' => 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'gender' => 'required',
            'phone_number' => 'required|unique:users,phone_number',
            'image' => 'required|image|mimes:webp,jpeg,jpg,png,gif,jfif',
            'name' => 'required',
            'certificates.*' => 'image|mimes:jpeg,png,jpg,webp,gif,jfif',
            'class' => 'required',
            'school' => 'required',
            'weaknesses_subjects' => 'required',
            'strong_subjects' => 'required',
            'father_name' => 'required',
            'mother_name' => 'required',
            'birthday' => 'required',
            'address' => 'required',
            'city' => 'required',
            'student_languages' => 'required|min:1',
            
        ];
    }

    public function messages()
    {
        if (App::getLocale() == 'ar') {
            return [
                'username.required' => 'يجب كتابة اسم مستخدم',
                'username.unique' => 'يجب أن يكون اسم المستخدم فريد',

                'email.required' => 'يجب وضع البريد الالكتروني',
                'email.unique' => 'يجب أن يكون البريد الالكتروني فريد',
                'email.email' => 'يجب أن يكون بريد الكتروني',

                'password.required' => 'يجب كتابة كلمة سر',
                'password.min' => 'يجب أن تكون كلمة السر على الأقل 8 محارف ',

                'gender.required' => 'يجب وضع جنس للطالب',

                'phone_number.required' => 'يجب وضع رقم للطالب',
                'phone_number.unique' => 'يجب أن يكون الرقم فريد',

                'image.required' => 'يجب وضع صورة للطالب',
                'image.image' => 'يجب أن يكون الملف صورة',
                'image.mimes' => 'يجب أن تكون لاحقة الصورة احدى اللواحق التالية jpeg,png,jpg,webp,gif,jfif',

                'name.required' => 'يجب كتابة اسم للطالب',

                'certificates.*.image' => 'يجب أن تكون شهادات الطالب عبارة عن صور',
                'certificates.*.mimes' => 'يجب ان تكون لاحقة الصور ضمن اللواحق التالية jpeg,png,jpg,webp,gif,jfif',

                'class.required' => 'يجب وضع صف للطالب',

                'school.required' => 'يجب وضع مدرسة للطالب',

                'weaknesses_subjects.required' => 'يجب وضع مواد الطالب ضعيف فيها',

                'strong_subjects.required' => 'يجب وضع مواد الطالب قوي فيها',

                'father_name.required' => 'يجب كتابة اسم والد الطالب',

                'mother_name.required' => 'يجب كتابة اسم والدة الطالب',

                'birthday.required' => 'يجب وضع تاريخ ميلاد لطالب',

                'address.required' => 'يجب كتابة عنوان الطالب',

                'city.required' => 'يجب وضع مدينة الطالب',

                'student_languages.required' => 'يجب وضع لغات للطالب',
                'student_languages.array' => 'يجب أن تكون اللغات عبارة عن مصفوفة',
                'student_languages.min' => 'يجب وضع لغة واحدة على الأقل',

            ];
        }
        if (App::getLocale() == 'en') {
            return Parent::messages();
        }
    }
}
