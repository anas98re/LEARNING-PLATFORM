<?php

namespace Modules\Sections\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class WebSiteLibraryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'is_free' =>  $this->is_free,
        ];
    }
}
