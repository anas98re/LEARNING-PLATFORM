<?php

namespace Modules\Sections\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class UnitResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

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

            return $data;
        }

        return parent::collection($data);
    }

    public function hide(array $fields)
    {
        $this->withoutFields = $fields;
        return $this;
    }

    protected function filterFields($array)
    {
        return collect($array)->forget($this->withoutFields)->toArray();
    }


    public function toArray($request)
    {
        if ($this->unit) // to check if the data come from with_auth or not
            return  $this->filterFields([
                'unit_id' => $this->id,
                'unit_name' => $this->unit->name,
                'unit_description' => $this->unit->description,
                'unit_cover' => $this->unit->cover,
                'can_access' => $this->can_access,
                //    'is_Free'=>$this->unit->is_Free,
                'lessons_count' => $this->lessons_count,
                'lessons_sum_duration' => $this->lessons_sum_duration,
                'requirements' => explode(',', (string) $this->requirements),
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,

            ]);
        else
            return  $this->filterFields([
                'unit_id' => $this->id,
                'unit_name' => $this->name,
                'unit_video' => $this->video,
                'unit_description' => $this->description,
                'unit_cover' => $this->cover,
                'lessons_count' => $this->lessons_count,
                'lessons_sum_duration' => $this->lessons_sum_duration,
                'requirements' => explode(',', (string) $this->requirements),

                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
            ]);
    }
}
