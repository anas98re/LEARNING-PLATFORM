<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\ApiController;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admin\Entities\TransferCenter;
use Modules\Admin\Entities\TransferCenterCode;
use Modules\Admin\Http\Requests\GetLimitRequest;
use Modules\Admin\Http\Requests\TransferCenterCodeRequest;
use Modules\Admin\Transformers\TransferCenterCodeResource;

class TransferCenterCodeController extends ApiController
{

    public function get_all_transfer_center_code(GetLimitRequest $request)
    {

        $transfer_center_code = TransferCenterCode::with('transferCenter')->latest('created_at')->paginate($request->limit);
        if ($transfer_center_code) {
            return $this->success(TransferCenterCodeResource::collection($transfer_center_code));
        } else {
            return $this->error(["There'\s no transfer center code to show"], "There'\s no transfer center code to show", 404);
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function add_transfer_center_code(TransferCenterCodeRequest $request)
    {

        $data = $request->all();

        $transfer_center = TransferCenter::find($request->transfer_center_id);
        $nameCode = substr($transfer_center->name, 0, 5);
        $data['code'] = $nameCode . $this->generateRandomString(15);
        $transfer_center_code = TransferCenterCode::create($data);
        $transfer_center_code = TransferCenterCode::where('id', $transfer_center_code->id)->with('transferCenter')->first();
        return $this->success(new TransferCenterCodeResource($transfer_center_code));
    }



    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update_transfer_center_code(TransferCenterCodeRequest $request, $id)
    {
        $transfer_center_code = TransferCenterCode::where('id', $id)->with('transferCenter')->first();
        if ($transfer_center_code) {
            $data = $request->all();
            if ($request->transfer_center_id) {
                $transfer_center = TransferCenter::find($request->transfer_center_id);
                $nameCode = substr($transfer_center->name, 0, 5);
                $data['code'] = $nameCode . $this->generateRandomString(15);
            }
            $transfer_center_code->update($data);

            return  $this->success(new TransferCenterCodeResource($transfer_center_code), 200);
        } else
            return  $this->error('there no records has this ids', 'There no records has this id', 404);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function delete_transfer_center_code($id)
    {
        $transfer_center_code = TransferCenterCode::find($id);
        if ($transfer_center_code) {
            $transfer_center_code->delete();
            return $this->success('deleted successfully');
        } else {
            return $this->error(["There'\s no transfer center code in this id"], "There'\s no transfer center code in this id", 204);
        }
    }
    function generateRandomString($length)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
