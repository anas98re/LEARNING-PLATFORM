<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\ApiController;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Modules\Admin\Http\Requests\UnitRequest;
use Modules\Admin\Transformers\UnitResource;
use Modules\Sections\Entities\Units\Unit;

class UnitController extends ApiController
{
    public function CreateUnit(UnitRequest $request)
    {
        $data = $request->all();
        if ($request->hasFile('cover')) {
            $data['cover'] = $request->file('cover')->store('public/Unit/cover');
        }
        if ($request->hasFile('video')) {
            $data['video'] = $request->file('video')->store('public/Unit/video');
        }
        $data['name'] = $request->transable == 0 ?
            ["ar" => $data['name'], "en" => ''] :
            ["ar" => $data['name'], "en" => $data['name_en']];
        $data['description'] = $request->transable == 0 ?
            ["ar" => $data['description'], "en" => ''] :
            ["ar" => $data['description'], "en" => $data['description_en']];
        $data['requirements'] = $request->transable == 0 ?
            ["ar" => $data['requirements'], "en" => ''] :
            ["ar" => $data['requirements'], "en" => $data['requirements_en']];

        $unit = Unit::create($data);
        return $this->success(new UnitResource($unit));
    }

    public function updateUnit(UnitRequest $request, $id)
    {
        $data = $request->all();
        $Unit = Unit::find($id);
        if ($Unit) {
            if ($request->hasFile('cover')) {
                if ($Unit->cover &&  Storage::exists($Unit->cover)) {
                    Storage::delete($Unit->cover);
                }
                $data['cover'] = $request->file('cover')->store('public/Unit/cover');
            }
            if ($request->hasFile('video')) {
                if ($Unit->video &&  Storage::exists($Unit->video)) {
                    Storage::delete($Unit->video);
                }
                $data['video'] = $request->file('video')->store('public/Unit/video');
            }
            $data['name'] = $request->transable == 0 ?
                ["ar" => $data['name'], "en" => ''] :
                ["ar" => $data['name'], "en" => $data['name_en']];
            $data['description'] = $request->transable == 0 ?
                ["ar" => $data['description'], "en" => ''] :
                ["ar" => $data['description'], "en" => $data['description_en']];
            $data['requirements'] = $request->transable == 0 ?
                ["ar" => $data['requirements'], "en" => ''] :
                ["ar" => $data['requirements'], "en" => $data['requirements_en']];

            $Unit->update($data);
            return $this->success(new UnitResource($Unit));
        } else {
            return $this->error(["The Unit does not exist"], "The Unit does not exist", 204);
        }
        return $Unit;
    }

    public function deletedUnit($id)
    {
        $Unit = Unit::find($id);
        if ($Unit) {
            if ($Unit->cover && Storage::exists($Unit->cover)) {

                Storage::delete($Unit->cover);
            }
            if ($Unit->video && Storage::exists($Unit->video)) {

                Storage::delete($Unit->video);
            }
            $Unit->delete();
            return $this->success('The deletion process has been completed successfully');
        } else {
            return $this->error(["The Unit does not exist"], "The Unit does not exist", 204);
        }
    }
}
