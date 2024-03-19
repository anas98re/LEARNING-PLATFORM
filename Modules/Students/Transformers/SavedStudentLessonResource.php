<?php

namespace Modules\Students\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class SavedStudentLessonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'lesson_id' => $this->lesson_id,
            'subject_id' => $this->student_saved_subject->subject_id,
            'lesson_name' => $this->lesson->name,
        ];
    }
}
