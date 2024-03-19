<?php

namespace Modules\Sections\Transformers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class UnitCommentResource extends JsonResource
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

        return tap(new UnitCommentCollection($data), function ($collection) {
            $collection->collects = __CLASS__;
        });  }
        return tap(new UnitCommentCollection(parent::collection($data)), function ($collection) {
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
            'id' => $this->id,
            'student_name' =>  $this->student->user->username,
            'student_id' => $this->student_id,
            'student_image' =>  User::find($this->student->user_id)->image,
            'date_time' => Carbon::parse($this->created_at)->format('Y-m-d H:i:s'),
            'comment' => $this->comment,
        ]);
    }
}
