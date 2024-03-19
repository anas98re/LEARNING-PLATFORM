<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\ApiController;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Modules\Admin\Http\Requests\PaymentRequest;
use Modules\Students\Entities\Payment;
use Modules\Students\Entities\Student;
use Modules\Students\Http\Requests\GetAllPaymentRequest;

use Modules\Students\Transformers\PaymentResource;
use Illuminate\Support\Str;
use Modules\Admin\Transformers\UpdatePaymentResource;

class PaymentController extends ApiController
{

    public function get_all_payments(GetAllPaymentRequest $request)
    {
        $payment = Payment::with('student.user')->latest('created_at')->paginate($request->limit);
        if ($payment) {
            return $this->success(PaymentResource::collection($payment));
        } else {
            return $this->error(["There'\s no Payment"], "There'\s no Payment", 404);
        }
    }

    public function add_balance_to_student_by_admin(PaymentRequest $request)
    {
        $student = Student::where('id', $request->student_id)->first();
        $user = User::where('id', $student->user_id)->first();
        if ($student) {
            $data = $request->all();
            if ($request->hasFile('payment_image') && $request->payment_image) {
                $image_path = $request->file('payment_image')->store('public/students/payment/' . Str::slug($user->username));
                $data['payment_image'] = $image_path;
            }
            $data['is_aproved'] = true;
            $data['balance_before'] = $student->balance;
            $student->balance = $student->balance + $request->balance;
            $data['balance_after'] = $student->balance;
            $payment = Payment::create($data);
            $student->update();
            $payment = Payment::where('id', $payment->id)->with('student.user')->get();
            return $this->success(PaymentResource::collection($payment));
        } else {
            return $this->error(["The account entered is incorrect or it is not a student"], "The account entered is incorrect or it is not a student", 401);
        }
    }

 

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function edit_payment(PaymentRequest $request, $id)
    {
        $student = Student::where('id', $request->student_id)->first();
        $user = User::where('id', $student->user_id)->first();
        if ($student) {
            $payment = Payment::where('id', $id)->first();
            $data = $request->all();
            if ($payment) {
                if ($request->hasFile('payment_image')) {
                    if (Storage::exists($payment->payment_image)) {
                        Storage::delete($payment->payment_image);
                    }
                    $image_path = $request->file('payment_image')->store('public/students/payment/' . Str::slug($user->username));
                    $data['payment_image'] = $image_path;
                }
                $data['is_aproved'] = true;
                $data['balance_before'] = $payment->balance_before;
                $old_student_balance = $payment->balance_before;
                $student->balance = $old_student_balance + $request->balance;
                $data['balance_after'] = $student->balance;
                $payment->update($data);
                $student->update();
                $payment = Payment::where('id', $payment->id)->with('student.user')->get();
                return $this->success(PaymentResource::collection($payment));
            } else {
                return $this->error(["There'\s no Payment in this id or is has aproved  so you can't update on it"], "There'\s no Payment in this id or is has aproved  so you can't update on it", 204);
            }
        } else {
            return $this->error(["The account entered is incorrect or it is not a student"], "The account entered is incorrect or it is not a student", 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function delete_payment($id)
    {
        $payment = Payment::find($id);
        if ($payment) {
            if (Storage::exists($payment->payment_image)) {
                Storage::delete($payment->payment_image);
            }
            $payment->delete();
            return $this->success('deleted successfully');
        } else {
            return $this->error(["There'\s no Payment in this id"], "There'\s no Payment in this id", 204);
        }
    }
}
