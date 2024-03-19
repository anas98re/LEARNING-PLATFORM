<?php

namespace Modules\Sections\Transformers;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UnitResourceCollection extends ResourceCollection
{
    protected $withoutFields = [];

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
        return $this->collection->map(function (UnitResource $resource) use ($request) {
            return $resource->hide($this->withoutFields)->toArray($request);
        })->all();
    }
}
