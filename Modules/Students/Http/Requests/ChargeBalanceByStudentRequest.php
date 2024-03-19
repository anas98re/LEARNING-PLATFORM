<?php

namespace Modules\Students\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\App;
use Illuminate\Validation\Rule;
use Modules\Students\Entities\Student;

class ChargeBalanceByStudentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $user = auth('sanctum')->user();
        $student = Student::where('user_id', $user->id)->first();
        $required_balance =  $this->balance > $student->balance ? 'max:' . $student->balance : '';
        return [
            'balance' => 'required|numeric|' . $required_balance,
            'username_receiver' => [
                'required',
                Rule::exists('users', 'username')->where('role_id', 1)->whereNot('username', $user->username),
            ],
        ];
    }

    public function messages()
    {
        if (App::getLocale() == 'ar') {
            return [
                'balance.required' => 'يجب وضع رصيد ',
                'balance.numeric' => 'يجب أن يكون الرصيد رقم',

                'balance.max' => 'يجب أن تكون قيمة التحويل أصغر أو تساوي رصيد الطالب',

                'username_receiver.required' => 'يجب اختيار الشخص المستلم للتحويل',
                'username_receiver.exists' => 'يجب أن يكون الشخص المستلم للتحويل موجود',
            ];
        }
        if (App::getLocale() == 'en') {
            return Parent::messages();
        }
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
