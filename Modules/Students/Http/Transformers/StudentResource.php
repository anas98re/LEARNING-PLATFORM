<?php

namespace Modules\Students\Http\Transformers;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Sections\Entities\Student;

class StudentResource extends JsonResource
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
            'student_name' => $this->user->username,
            'student_email' => $this->user->email,
            'student_image' => $this->user->image,
            'student_father_name' => $this->father_name,
            'student_mother_name' => $this->mother_name,
            'student_address' => $this->address,
            'student_city' => $this->city,
        ];
    }
}
