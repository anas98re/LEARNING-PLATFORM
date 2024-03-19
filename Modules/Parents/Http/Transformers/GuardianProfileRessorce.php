<?php

namespace Modules\Parents\Http\Transformers;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Sections\Entities\Student;

class GuardianProfileRessorce extends JsonResource
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
            'username' => $this->user->username,
            'phone_number' => $this->user->phone_number,
            'email' => $this->user->email,
            'image' => $this->user->image,
        ];
    }
}
