<?php

namespace App\Http\Transformers;

use App\Models\User;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class UserOpinionResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
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

        return new  parent($data);
    }
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'user_name' => User::find($this->user_id)->name,
            'user_image' => $this->user_image,
            'opinion' => $this->opinion,
        ];
    }
}
