<?php

namespace Modules\Admin\Transformers;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Sections\Entities\Subjects\Subject;

class subjectResource extends JsonResource
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
        $data =   Subject::withCount(['units', 'lessons'])->where('id', $this->id)->get();
        $lesson_count = $data[0]->lessons_count;
        return [
            'subject_id' => $this->id,
            'subject_name' => $this->name,
            'introductry_video' => $this->introductory_video,
            'number_of_units_in_the_subject' => $this->units->count(),
            'number_of_lessons' => $lesson_count,
            // teachers_name must be comma separated in the next version
            'teacher_description' => (!$this->teachers->isEmpty()) ? $this->teachers[0]->description :
                "there_is_no_teacher_related_to_this_subject",
            'teacher_image' => (!$this->teachers->isEmpty()) ? User::find($this->teachers[0]->user_id)->image :
                "there_is_no_teacher_related_to_this_subject",
            'teacher id' => (!$this->teachers->isEmpty()) ? $this->teachers[0]->id :
                "there_is_no_teacher_related_to_this_subject",
            'subject_description' => $this->description,
            'subject_req' => $this->requirements,
            'sub_section_id' => $this->sub_section_id,
            'sub_section_name' => $this->subSection->name,
            'price' => $this->price,
            'cover' => $this->cover,
        ];
    }
}
