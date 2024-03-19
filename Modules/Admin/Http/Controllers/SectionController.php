<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\ApiController;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Seeder;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Modules\Admin\Http\Requests\SectionRequest;
use Modules\Admin\Transformers\SectionResource;
use Modules\Sections\Entities\Section;

class SectionController extends ApiController
{

    public function addSection(SectionRequest $request)
    {
        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public/Section');
        }
        $data = $request->all();
        $data['image'] = $path;
        $data['name'] = $request->transable == 0 ?
            ["ar" => $data['name'], "en" => ''] :
            ["ar" => $data['name'], "en" => $data['name_en']];
        $Section = Section::create($data);
        return $this->success(new SectionResource($Section));
    }

    public function updateSection(SectionRequest $request, $id)
    {
        $data = $request->all();
        $section = Section::find($id);
        if ($section) {
            $data['name'] = $request->transable == 0 ?
                ["ar" => $data['name'], "en" => ''] :
                ["ar" => $data['name'], "en" => $data['name_en']];
            if ($request->hasFile('image')) {
                if ($section->image &&  Storage::exists($section->image)) {
                    Storage::delete($section->image);
                }
                $data['image'] = $request->file('image')->store('public/Section');
            }
            $section->update($data);
            return $this->success(new SectionResource($section));
        } else {
            return $this->error(["The Section does not exist"], "The Section does not exist", 204);
        }
        return $section;
    }

    public function deletedSection($id)
    {
        $Section = Section::find($id);
        if ($Section) {
            if ($Section->image && Storage::exists($Section->image)) {

                Storage::delete($Section->image);
            }
            $Section->delete();
            return $this->success('The deletion process has been completed successfully');
        } else {
            return $this->error(["The Section does not exist"], "The Section does not exist", 204);
        }
    }
}
