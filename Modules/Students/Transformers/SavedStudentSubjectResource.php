<?php

namespace Modules\Students\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class SavedStudentSubjectResource extends JsonResource
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
            'student_id' => $this->student_id,
            'subject_id' => $this->subject_id,
            'subject_name' => $this->subject->name,
        ];
    }
}
