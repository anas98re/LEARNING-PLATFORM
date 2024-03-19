<?php

namespace Modules\Admin\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class LessonResource extends JsonResource
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
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'cover' => $this->cover,
            'is_Free' => $this->isFree,
            'unit_id' => $this->unit_id,
            'unit_name' => $this->unit->name,
            'subject_id' => $this->subject_id,
            'subject_name' => $this->subject->name,
            'points' => $this->points,
            'duration' => $this->duration,
            'video' => $this->video,
            'what_we_will_learn' => $this->what_we_will_learn,
            'faqs' => $this->faqs,
        ];
    }
}
