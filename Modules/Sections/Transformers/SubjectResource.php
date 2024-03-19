<?php

namespace Modules\Sections\Transformers;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Sections\Entities\Subjects\Subject;

class SubjectResource extends JsonResource
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
                "NULL",
            'teacher_image' => (!$this->teachers->isEmpty()) ? User::find($this->teachers[0]->user_id)->image :
                "NULL",
            'teacher id' => (!$this->teachers->isEmpty()) ? $this->teachers[0]->id :
                "NULL",
            'subject_description' => $this->description,
            'subject_req' => explode(',', (string) $this->requirements),
        ];
    }
}
