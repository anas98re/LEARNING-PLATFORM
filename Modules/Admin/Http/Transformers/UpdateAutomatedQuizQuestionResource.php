<?php

namespace Modules\Admin\Http\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class UpdateAutomatedQuizQuestionResource extends JsonResource
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

        return new  parent($data);
    }
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'question' => $this->question,
            'point' =>  $this->point,
            'options' => $this->aqqOption,
            'automated_quiz_id' => $this->automated_quiz_id,
        ];
    }
}
