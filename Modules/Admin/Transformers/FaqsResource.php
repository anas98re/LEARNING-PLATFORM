<?php

namespace Modules\Admin\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class FaqsResource extends JsonResource
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

        return  parent::collection($data);
    }
    public function toArray($request)
    {
        if ($this->lesson_id) {
            $theKey = 'lesson_name';
            $relationshipName = $this->lesson->name;
        } elseif ($this->unit_id) {
            $theKey = 'unit_name';
            $relationshipName = $this->unit->name;
        } else {
            $theKey = 'subject_name';
            $relationshipName = $this->subject->name;
        }

        return [
            'id' => $this->id,
            'question' => $this->question,
            'answer' => $this->answer,
            'lesson_id' => $this->lesson_id,
            'unit_id' => $this->unit_id,
            'subject_id' => $this->subject_id,
            $theKey  => $relationshipName,
        ];
    }
}
