<?php

namespace Modules\Sections\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class TraditionalQuizFilesResource extends JsonResource
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
            'traditional_file_id' => $this->id,
            'traditional_file_links' => $this->file_links,
        ];
    }
}
