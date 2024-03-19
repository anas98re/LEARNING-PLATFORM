<?php

namespace Modules\Admin\Http\Controllers;

// use App\Models\User;

use App\Http\Controllers\ApiController;
use App\Models\User;
use App\Models\Role;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Modules\Admin\Http\Requests\GetAllLimitRequest;
use Modules\Admin\Http\Requests\parentRequest;
use Modules\Admin\Transformers\parentResource;
use Modules\Parents\Entities\Guardian;


class Parent1Controller extends ApiController
{
    public function getAllParents(GetAllLimitRequest $request)
    {
        $parent = Guardian::with('user')->paginate($request->limit);
        return $this->success(parentResource::collection($parent));
    }
    public function addParent(parentRequest $request)
    {
        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('public/users/parents');
        }
        $data['password'] = Hash::make($request->password);
        $data['role_id'] = 3;
        $varUser = User::create($data);
        $varParent = Guardian::create([
            'user_id' => $varUser->id,
        ]);
        $guardian = Guardian::with('user')->find($varParent->id);
        if ($guardian) {
            return $this->success(new parentResource($guardian));
        } else {
            return $this->error(["The Teacher does not exist"], "The Teacher does not exist", 204);
        }
    }

    public function updateParent(parentRequest $request, $id)
    {
        $data = $request->all();
        $user = User::find($id);

        $path = null;
        if ($user->image && Storage::exists($user->image)) {
            Storage::delete($user->image);
        }
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public/users/parents');
        }
        $data['password'] = Hash::make($request->password);
        $data['image'] = $path;
        $user->update($data);
        $guardian = Guardian::with('user')->find($user->id);
        if ($user) {
            return $this->success(new parentResource($guardian));
        } else {
            return $this->error(["The parent does not exist"], "The parent does not exist", 204);
        }
    }


    public function deletedParent($id)
    {
        $Guardian = Guardian::find($id);
        if ($Guardian) {
            $user = User::find($Guardian->user_id);

            if ($user->image && Storage::exists($user->image)) {

                Storage::delete($user->image);
            }
            $Guardian->delete();
            $user->delete();
            return $this->success('The deletion process has been completed successfully');
        } else {
            return $this->error(["The Guardian does not exist"], "The Guardian does not exist", 204);
        }
    }
}
