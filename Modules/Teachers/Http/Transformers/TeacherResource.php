<?php

namespace Modules\Teachers\Http\Transformers;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Sections\Entities\Student;

class TeacherResource extends JsonResource
{
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
       
            return  parent::collection($data);
    
    }
    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'username' => $this->user->username,
            'email' => $this->user->email,
            'password' => $this->user->password,
            'gender' => $this->user->gender,
            'subjects_counts' => $this->subjects_counts,
            'description' => $this->description,
            'image' => $this->user->image,
            'role_id' => $this->user->role_id,
            'remember_token' =>  $this->user->remember_token,
        ];
    }
}
