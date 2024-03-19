<?php

namespace Modules\Admin\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionResource extends JsonResource
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
            'subscription_id' => $this->id,
            'subscription_name' => $this->name,
            'subscription_image' => $this->image,
            'subscription_price' => $this->price,
            'subscription_description' => $this->description,
        ];
    }
}   
