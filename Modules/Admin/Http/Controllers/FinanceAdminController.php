<?php

namespace Modules\Admin\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Controllers\ApiController;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Constants;
use Modules\Admin\Http\Requests\GetAllFinanceAdminsRequest;
use Modules\Admin\Http\Requests\UpdateFinanceAdminRequest;

class FinanceAdminController extends ApiController
{
    public function get_all_finance_admins(GetAllFinanceAdminsRequest $request)
    {
        $finance_admins = User::where('role_id', 5)->paginate($request->limit);
        if ($finance_admins->first()) {
            return $this->success($finance_admins);
        } else {
            return $this->error(["There'\s no finance admins"], "There'\s no finance admins", 204);
        }
    }

    public function delete_finance_admin($id)
    {
        $finance_admin = User::where('id', $id)->where('role_id', 5)->first();
        if ($finance_admin) {
            $finance_admin->delete();
            return  $this->success('Deleted successfully', 200);
        } else {
            return  $this->error('there no records has this id', 'There no records has this id', 404);
        }
    }

    public function update_finance_admin(UpdateFinanceAdminRequest $request, $id)
    {
        $finance_admin = User::where('id', $id)->where('role_id', Constants::FINANCE_ADMIN_ID)->first();
        if ($finance_admin) {
            $data = $request->all();
            if ($request->hasFile('image')) {
                if (Storage::exists($finance_admin->image)) {
                    Storage::delete($finance_admin->image);
                }
                $path = $request->file('image')->store('public/admin/finance_admin');
                $data['image'] = $path;
            }
            if ($request->password) {
                $data['password'] = Hash::make($request->password);
            }

            $finance_admin->update($data);
            return $this->success(["finance admin updated successfully"], 200);
        } else {
            return  $this->error('there no records has this id', 'There no records has this id', 404);
        }
    }
}
