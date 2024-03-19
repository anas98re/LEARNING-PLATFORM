<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\ApiController;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Students\Entities\Payment;
use Modules\Students\Entities\Student;

class AcceptController extends ApiController
{
    public function student_payment_aprove($id)
    {

        $payment = Payment::find($id);
       if ($payment->is_aproved){
        return $this->error(["this payment already aproved "], "this payment already aproved ", 404);

       }
        if ($payment) {
            $student = Student::where('id', $payment->student_id)->first();
            $payment->balance_before = $student->balance;
            $student->balance = $student->balance + $payment->balance;
            $payment->balance_after = $student->balance;
            $student->update();
            $payment->is_aproved = true;
            $payment->update();
            $payment = Payment::find($id);
            return $this->success('Payment confirmed successfully');
        } else {
            return $this->error(["There'\s no Payment"], "There'\s no Payment", 404);
        }
    }

    public function active_user_account($id)
    {
        $account = User::find($id);
        if($account->is_active) {
            return $this->error(["this account is already activated "], "this account is already activated ", 404);

        }
        if ($account) {
            $account->is_active = true;
            $account->update();
            $account = User::find($id);
            return $this->success('account is activeted successfully');
        } else {
            return $this->error(["There'\s no account in this id"], "There'\s no account in this id", 404);
        }
    }
}
