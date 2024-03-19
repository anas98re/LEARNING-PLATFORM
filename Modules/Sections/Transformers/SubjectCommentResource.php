<?php

namespace Modules\Sections\Transformers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class SubjectCommentResource extends JsonResource
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
        return [
            'id' => $this->id,
            'student_name' => $this->student->user->username,
            'comment' => $this->comment,
            'student_id' => $this->student_id,
            'student_image' =>  $this->student->user->image,
            'date_time' => Carbon::parse($this->created_at)->format('Y-m-d H:i:s'),
        ];
    }
}
