<?php

namespace Modules\Sections\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class SubSectionResource extends JsonResource
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
            'sub_section_id' => $this->id,
            'sub_section_name' => $this->name,
            'sub_section_image' => $this->image,
            'section_id' => $this->section_id,
            'section_name' => $this->section->name,
        ];
    }
}
