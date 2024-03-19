<?php

namespace Modules\Admin\Http\Controllers;

use App\Constants;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Modules\Admin\Entities\Admin;
use Modules\Admin\Http\Requests\DeleteContentAdminRequest;
use Modules\Admin\Http\Requests\GetAllContentAdminsRequest;
use Modules\Admin\Http\Requests\UpdateContentAdminRequest;

class ContentAdminController extends ApiController
{
    public function get_all_content_admins(GetAllContentAdminsRequest $request)
    {
        $content_admins = User::where('role_id', 4)->paginate($request->limit);
        if ($content_admins->first()) {
            return $this->success($content_admins);
        } else {
            return $this->error(["There'\s no content admins"], "There'\s no content admins", 204);
        }
    }

    public function delete_content_admin($id)
    {
        $content_admin = User::where('id', $id)->where('role_id', 4)->first();
        if ($content_admin) {
            $content_admin->delete();
            return  $this->success('Deleted successfully', 200);
        } else {
            return  $this->error('there no records has this id', 'There no records has this id', 404);
        }
    }

    public function update_content_admin(UpdateContentAdminRequest $request, $id)
    {
        $content_admin = User::where('id', $id)->where('role_id', Constants::CONTENT_ADMIN_ID)->first();
        if ($content_admin) {
            $data = $request->all();
            if ($request->hasFile('image')) {
                if (Storage::exists($content_admin->image)) {
                    Storage::delete($content_admin->image);
                }
                $path = $request->file('image')->store('public/admin/content_admin');
                $data['image'] = $path;
            }

            if ($request->password) {
                $data['password'] = Hash::make($request->password);
            }

            $content_admin->update($data);
            return $this->success(["content admin updated successfully"], 200);
        } else {
            return  $this->error('there no records has this id', 'There no records has this id', 404);
        }
    }
}
