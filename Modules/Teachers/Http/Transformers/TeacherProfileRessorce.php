<?php

namespace Modules\Teachers\Http\Transformers;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Sections\Entities\Student;

class TeacherProfileRessorce extends JsonResource
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
            'teacher_username' => $this->user->username,
            'teacher_email' => $this->user->email,
            'phone_number' => $this->user->phone_number,
            'teacher_image' => $this->user->image,
        ];
    }
}
