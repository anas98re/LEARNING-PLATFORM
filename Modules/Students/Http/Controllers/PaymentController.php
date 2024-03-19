<?php

namespace Modules\Students\Http\Controllers;

use App\Http\Controllers\ApiController;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Modules\Students\Entities\Payment;
use Modules\Students\Entities\Student;
use Modules\Students\Http\Requests\GetAllPaymentRequest;
use Modules\Students\Http\Requests\PaymentRequest;
use Modules\Students\Transformers\PaymentResource;
use Illuminate\Support\Str;

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

    public function post_payment(PaymentRequest $request)
    {
        $user = auth('sanctum')->user();

        $student = Student::where('user_id', $user->id)->first();
        if ($student) {
            $data = $request->all();
            $data['student_id'] = $student->id;
            if ($request->hasFile('payment_image')) {
                $image_path = $request->file('payment_image')->store('public/students/payment/' . Str::slug($user->username));
                $data['payment_image'] = $image_path;
            }
            $data['is_aproved'] = false;
            $payment = Payment::create($data);
            $payment = Payment::where('id', $payment->id)->with('student.user')->get();
            return $this->success(PaymentResource::collection($payment));
        } else {
            return $this->error(["The account entered is incorrect or it is not a student"], "The account entered is incorrect or it is not a student", 401);
        }
    }

    public function edit_payment_by_id(PaymentRequest $request, $id)
    {
        $user = auth('sanctum')->user();

        $student = Student::where('user_id', $user->id)->first();
        if ($student) {
            $payment = Payment::where('id', $id)->where('is_aproved', false)->first();
            $data = $request->all();
            if ($payment) {
                if ($request->hasFile('payment_image')) {
                    if (Storage::exists($payment->payment_image)) {
                        Storage::delete($payment->payment_image);
                    }
                    $image_path = $request->file('payment_image')->store('public/students/payment/' . Str::slug($user->username));
                    $data['payment_image'] = $image_path;
                }
                $data['student_id'] = $student->id;
                $data['is_aproved'] = $payment->is_aproved;
                $payment->update($data);
                $payment = Payment::where('id', $payment->id)->with('student.user')->get();
                return $this->success(PaymentResource::collection($payment));
            } else {
                return $this->error(["There'\s no Payment in this id or is has aproved  so you can't update on it"], "There'\s no Payment in this id or is has aproved  so you can't update on it", 204);
            }
        } else {
            return $this->error(["The account entered is incorrect or it is not a student"], "The account entered is incorrect or it is not a student", 401);
        }
    }

    public function delete_payment_by_id($id)
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
