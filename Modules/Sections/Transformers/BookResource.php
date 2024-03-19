<?php

namespace Modules\Sections\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
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
            'pdf_path' => $this->pdf_path,
            'title' =>  $this->title,
            'author_name' =>  $this->author_name,
            'website_library_id' =>  $this->website_library_id,
            'website_library_name' =>  $this->websiteLibrary->name,

        ];
    }
}
