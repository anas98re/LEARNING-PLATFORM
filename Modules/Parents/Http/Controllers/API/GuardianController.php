<?php

namespace Modules\Parents\Http\Controllers\API;

use App\Http\Controllers\ApiController;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Modules\Parents\Entities\Guardian;
use Modules\Parents\Http\Requests\UpdatePasswordGuardinRequest;
use Modules\Parents\Http\Transformers\GuardianProfileRessorce;

class GuardianController extends ApiController
{
    public function get_guardian_profile()
    {
        $user = auth('sanctum')->user();
        $parent = Guardian::where('user_id', $user->id)->with('User')->get();
        if (!$parent) {
            return $this->success(GuardianProfileRessorce::collection($parent), 200);
        } else {
            return $this->error('Can not access', "There's no such parent", 401);
        }
    }
    public function update_guardian_password(UpdatePasswordGuardinRequest $request)
    {
        $user = auth('sanctum')->user();
        $guardian = Guardian::where('user_id', $user->id)->get();
        if (!empty($guardian)) {
            $user = User::find($user->id);
            $user->password = Hash::make($request->new_password);
            $user->update();
            $response = [
                'user' => $user,
            ];
            return $this->success($response, 200);
        } else {
            return $this->error('Can not access', "There's no such parent", 401);
        }
    }
}
