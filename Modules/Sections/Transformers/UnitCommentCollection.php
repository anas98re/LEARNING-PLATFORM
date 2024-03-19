<?php

namespace Modules\Sections\Transformers;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UnitCommentCollection extends ResourceCollection
{
    protected $withoutFields = [];
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
        return $this->processCollection($request);
    }

    public function hide(array $fields)
    {
        $this->withoutFields = $fields;
        return $this;
    }

    protected function processCollection($request)
    {
        return $this->collection->map(function (UnitCommentResource $resource) use ($request) {
            return $resource->hide($this->withoutFields)->toArray($request);
        })->all();
    }
}