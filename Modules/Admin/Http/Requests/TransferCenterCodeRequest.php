<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\App;

class TransferCenterCodeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'transfer_center_id' => 'required|exists:transfer_centers,id',
            'is_transfer' => 'boolean',
            'transfer_date' => 'required_with:is_transfer|date_format:Y-m-d',
            'balance' => 'required|integer',
        ];
    }


    public function messages()
    {
        if (App::getLocale() == 'ar') {
            return [
                'balance.required' => 'يجب كتابة مبلغ لقيمة التحويل',
                'balance.integer' => 'يجب أن يكون المبلغ رقم صحيح',

                'transfer_center_id.required' => 'يجب اختيار مركز للتحويل',
                'transfer_center_id.exists' => 'يجب أن يكون مركز التحويل موجود',

                'is_transfer.boolean' => 'يجب أن تكون قيمة التحويل إما 0 أو 1',

                'transfer_date.required_with' => 'يجب وضع تاريخ للتحويل في حاول وجوده',
                'transfer_date.date_format' => 'يجب وضع تاريخ للتحويل',

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
