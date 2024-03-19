<?php

namespace Modules\Sections\Transformers;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class LessonResource extends JsonResource
{

    protected $withoutFields = [];
    public static function collection($data) // use this if you are using hide
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

            return tap(new LessonResourceCollection($data), function ($collection) {
                $collection->collects = __CLASS__;
            });
        }

        return tap(new LessonResourceCollection(parent::collection($data)), function ($collection) {
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
            'lesson_id' => $this->id,
            'lesson_name' => $this->name,
            'lesson_image' => $this->cover,
            'teacher name' => (!$this->unit->subject->teachers->isEmpty()) ? // ?????
                User::find($this->unit->subject->teachers[0]->user_id)->name : //?????
                "NULL",
            // teachers_name must be comma separated in the next version 
            'lesson_description' => $this->description,
            'lesson_video' => $this->video,
            'lesson_duration' => $this->duration,
            'lesson_points' => $this->points,
            'unit_name' => $this->unit->name,
            'subject_name' => $this->unit->subject->name,
            'what_we_will_learn' => explode(',', (string) $this->what_we_will_learn),
            'faqs' => $this->faqs,
            'lesson_attachments' => $this->when('lesson_attachments', LessonAttachmentResource::collection($this->lesson_attachments)),
            'subject_id' => $this->subject_id,
            // 'lesson_attachments' => $this->when('lesson_attachments', LessonAttachmentResource::collection($this->lesson_attachments)),
        ]);
    }
}
