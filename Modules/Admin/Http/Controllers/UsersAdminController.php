<?php

namespace Modules\Admin\Http\Controllers;

use App\Constants;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admin\Http\Requests\GetAllUsersAdminsRequest;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Modules\Admin\Http\Requests\UpdateUsersAdminRequest;

class UsersAdminController extends ApiController
{
    public function get_all_users_admins(GetAllUsersAdminsRequest $request)
    {
        $users_admins = User::where('role_id', 6)->paginate($request->limit);
        if ($users_admins->first()) {
            return $this->success($users_admins);
        } else {
            return $this->error(["There'\s no users admins"], "There'\s no users admins", 204);
        }
    }

    public function delete_users_admin($id)
    {
        $users_admin = User::where('id', $id)->where('role_id', 6)->first();
        if ($users_admin) {
            $users_admin->delete();
            return  $this->success('Deleted successfully', 200);
        } else {
            return  $this->error('there no records has this id', 'There no records has this id', 404);
        }
    }

    public function update_users_admin(UpdateUsersAdminRequest $request, $id)
    {
        $users_admin = User::where('id', $id)->where('role_id', Constants::USERS_ADMIN_ID)->first();
        if ($users_admin) {

            $data = $request->all();
            if ($request->hasFile('image')) {
                if (Storage::exists($users_admin->image)) {
                    Storage::delete($users_admin->image);
                }
                $path = $request->file('image')->store('public/admin/users_admin');
                $data['image'] = $path;
            }
            if ($request->password) {
                $data['password'] = Hash::make($request->password);
            }

            $users_admin->update($data);
            return $this->success(["Users admin updated successfully"], 200);
        } else {
            return  $this->error('there no records has this id', 'There no records has this id', 404);
        }
    }
}
