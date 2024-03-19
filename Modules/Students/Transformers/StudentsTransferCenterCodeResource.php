<?php

namespace Modules\Students\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentsTransferCenterCodeResource extends JsonResource
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
            'code' => $this->code,
            'transfer_center_id' => $this->transfer_center_id,
            'transfer_center_name' => $this->transferCenter->name,
            'is_transfer' => $this->is_transfer,
            'transfer_date' => $this->transfer_date,
            'balance' => $this->balance,
            'student_id' => $this->student_id,
            'student_name' => $this->student->user->name,
            'student_balance' => $this->student->balance,
        ];
    }
}
