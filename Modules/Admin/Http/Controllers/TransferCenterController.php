<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\ApiController;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admin\Entities\TransferCenter;
use Modules\Admin\Http\Requests\GetLimitRequest;
use Modules\Admin\Http\Requests\TransferCenterRequest;
use Modules\Admin\Transformers\TransferCenterResource;

class TransferCenterController extends ApiController
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function get_all_transfer_centers(GetLimitRequest $request)
    {
        $transfer_center = TransferCenter::latest('created_at')->paginate($request->limit);
        if ($transfer_center) {
            return $this->success(TransferCenterResource::collection($transfer_center));
        } else {
            return $this->error(["There'\s no transfer center to show"], "There'\s no transfer center to show", 404);
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function add_transfer_center(TransferCenterRequest $request)
    {
        $data = $request->all();
        $transfer_center = TransferCenter::create($data);
        $transfer_center = TransferCenter::where('id', $transfer_center->id)->first();
        return $this->success(new TransferCenterResource($transfer_center));
    }


    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update_transfer_center(TransferCenterRequest $request, $id)
    {

        $transfer_center = TransferCenter::find($id);
        if ($transfer_center) {
            $data = $request->all();
            $transfer_center->update($data);
            return  $this->success(new TransferCenterResource($transfer_center), 200);
        } else
            return  $this->error('there no records has this ids', 'There no records has this id', 404);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function delete_transfer_center($id)
    {
        $transfer_center = TransferCenter::find($id);
        if ($transfer_center) {
            $transfer_center->delete();
            return $this->success('deleted successfully');
        } else {
            return $this->error(["There'\s no transfer center in this id"], "There'\s no transfer center in this id", 204);
        }
    }
}
