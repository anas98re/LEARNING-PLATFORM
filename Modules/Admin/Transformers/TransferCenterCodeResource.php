<?php

namespace Modules\Admin\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class TransferCenterCodeResource extends JsonResource
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
            'code' => $this->code,
            'transfer_center_id' => $this->transfer_center_id,
            'transfer_center_name' => $this->transferCenter->name,
            'is_transfer' => $this->is_transfer,
            'transfer_date' => $this->transfer_date,
            'balance' => $this->balance,
            'student_id' => $this->student_id,

        ];
    }
}
