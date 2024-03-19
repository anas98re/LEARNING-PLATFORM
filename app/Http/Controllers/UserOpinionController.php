<?php

namespace App\Http\Controllers;

use App\Models\UserOpinion;
use App\Http\Requests\StoreUserOpinionRequest;
use App\Http\Requests\UpdateUserOpinionRequest;
use App\Models\User;
use App\Http\Controllers\ApiController;
use App\Http\Requests\LimitRequest;
use App\Http\Transformers\UserOpinionResource ;

class UserOpinionController extends ApiController
{
    public function get_users_opinions(LimitRequest $request)
    {
        $opinion = UserOpinion::paginate($request->limit);
        return  $this->success(UserOpinionResource::collection($opinion), 200);
    }
    public function post_user_opinions(StoreUserOpinionRequest $request)
    {
        $opinion = new UserOpinion();
        $opinion->user_id = $request->user_id;
        $opinion->opinion = $request->opinion;
        $opinion->user_image = User::find($request->user_id)->image;
        $opinion->save();
        return $this->success($opinion, 200);
    }
}
