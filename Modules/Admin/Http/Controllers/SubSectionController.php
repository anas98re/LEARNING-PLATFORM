<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\ApiController;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Modules\Admin\Http\Requests\SubSectionRequest;
use Modules\Admin\Transformers\SubSectionResource;
use Modules\Sections\Entities\SubSection;

class SubSectionController extends ApiController
{
    public function addSubSection(SubSectionRequest $request)
    {
        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('public/SubSection');
        }
        $data['name'] = $request->transable == 0 ?
            ["ar" => $data['name'], "en" => ''] :
            ["ar" => $data['name'], "en" => $data['name_en']];
        $SubSection = SubSection::create($data);
        return $this->success(new SubSectionResource($SubSection));
    }

    public function updateSubSection(SubSectionRequest $request, $id)
    {
        $data = $request->all();
        $SubSection = SubSection::find($id);
        if ($SubSection) {
            $data['name'] = $request->transable == 0 ?
                ["ar" => $data['name'], "en" => ''] :
                ["ar" => $data['name'], "en" => $data['name_en']];
            if ($request->hasFile('image')) {
                if ($SubSection->image &&  Storage::exists($SubSection->image)) {
                    Storage::delete($SubSection->image);
                }
                $data['image'] = $request->file('image')->store('public/SubSection');
            }
            $SubSection->update($data);
            return $this->success(new SubSectionResource($SubSection));
        } else {
            return $this->error(["The SubSection does not exist"], "The SubSection does not exist", 204);
        }
    }

    public function deletedSubSection($id)
    {
        $SubSection = SubSection::find($id);
        if ($SubSection) {
            if ($SubSection->image && Storage::exists($SubSection->image)) {

                Storage::delete($SubSection->image);
            }
            $SubSection->delete();
            return $this->success('The deletion process has been completed successfully');
        } else {
            return $this->error(["The SubSection does not exist"], "The SubSection does not exist", 204);
        }
    }
}
