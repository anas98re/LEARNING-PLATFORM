<?php

namespace Modules\Students\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class ChargeBalanceByStudentResource extends JsonResource
{

    public static function collection($data)
    {
        /*
        This simply checks if the given data is and instance of Laravel's paginator classes
         and if it is, 
        it just modifies the underlying collection and returns the same paginator instance
        */
        if (is_a($data, \Illuminate\Pagination\AbstractPaginator::class)) {
            $data->setCollection(
                $data->getCollection()->map(function ($listing) {
                    return new static($listing);
                })
            );

            return $data;
        }

        return parent::collection($data);
    }
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'student_username' => $this->student->user->username,
            'student_receiver_username' => $this->studentReceiver->user->username,
            'student_image' => $this->student->user->image,
            'student_id' => $this->student_id,
            'student_receiver_id' => $this->student_receiver_id,
            'balance' => $this->balance,
            'student_balance_before' => $this->balance_before,
            'student_balance_after' => $this->balance_after,
            'student_receiver_balance_before' => $this->balance_after,
            'student_receiver_balance_after' => $this->balance_after,


            'is_aproved' => $this->is_aproved,
        ];
    }
}
