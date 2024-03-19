<?php

namespace Modules\Students\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
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
            'student_image' => $this->student->user->image,
            'student_balance' => $this->student->balance,
            'student_id' => $this->student_id,
            'payment_balance' => $this->balance,
            'student_balance_before' => $this->balance_before,
            'student_balance_after' => $this->balance_after,
            'payment_image' => $this->payment_image,
            'is_aproved' => $this->is_aproved,
            'role_id' => $this->role_id
        ];
    }
}
