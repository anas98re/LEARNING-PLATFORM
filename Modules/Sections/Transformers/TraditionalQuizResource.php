<?php

namespace Modules\Sections\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class TraditionalQuizResource extends JsonResource
{
    protected $withoutFields = [];
    public static function collection($resource)
    {
        return tap(new TraditionalQuizResourceCollection($resource), function ($collection) {
            $collection->collects = __CLASS__;
        });
    }


    // Set the keys that are supposed to be filtered out
    public function hide(array $fields)
    {
        $this->withoutFields = $fields;
        return $this;
    }

    // Remove the filtered keys.
    protected function filterFields($array)
    {
        return collect($array)->forget($this->withoutFields)->toArray();
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */

    public function toArray($request)
    {
        return  $this->filterFields([
            'quiz_id' => $this->id,
            'quiz_name' => $this->nameOfQuiz,
            'quiz_duration' => $this->duration,
            'quiz_points' => $this->points,
            'quiz_unit_id' => $this->unit_id,
            'quiz_lesson_id' => $this->lesson_id,
            'quiz_subject_id' => $this->subject_id,
            'quiz_description' => $this->description,
            'isFinal' => $this->isFinal,
            'is_open' => $this->isOpen,
            'isAboveLevel' => $this->isAboveLevel,
            'quiz_correction_Ladder_file_link' => $this->correction_Ladder_file_link,
            'traditional_quiz_images' => $this->when('traditional_quiz_images', TraditionalQuizFilesResource::collection($this->traditional_quiz_files)),
        ]);
    }
}
