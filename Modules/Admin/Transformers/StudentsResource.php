<?php

namespace Modules\Admin\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentsResource extends JsonResource
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
            'image' => $this->user->image,
            'role_id' => $this->user->role_id,
            'remember_token' =>  $this->user->remember_token,
            'class' => $this->class,
            'school' => $this->school,
            'weaknesses_subjects' => $this->weaknesses_subjects,
            'strong_subjects' => $this->strong_subjects,
            'father_name' => $this->father_name,
            'mother_name' => $this->mother_name,
            'birthday' => $this->birthday,
            'address' => $this->address,
            'city' => $this->city,
            'student_languages' => $this->student_languages,
        ];
    }
}
