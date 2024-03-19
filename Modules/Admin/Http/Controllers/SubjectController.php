<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\ApiController;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Modules\Admin\Http\Requests\SubjectRequest;
use Modules\Sections\Entities\Subjects\Subject;
use Modules\Admin\Transformers\SubjectResource;

class SubjectController extends ApiController
{
    public function show($id)
    {
        $Subject = Subject::findOrFail($id);
        return $Subject;
        // return $this->respond(MaterialCollection::collection([$material])[0]);
    }
    public function createSubject(SubjectRequest $request)
    {
        $data = $request->all();
        if ($request->hasFile('cover')) {
            $data['cover'] = $request->file('cover')->store('public/Subjects/cover');
        }

        if ($request->hasFile('introductory_video')) {
            $data['introductory_video'] = $request->file('introductory_video')->store('public/Subjects/introductory_video');
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
        $Subject = Subject::create($data);
        return $this->success(new SubjectResource($Subject));
        // return $this->sendResponse($varMaterial, 'Material added successullly');
    }

    public function updateSubject(SubjectRequest $request, $id)
    {
        $data = $request->all();
        $Subject = Subject::find($id);
        if ($Subject) {
            if ($request->hasFile('cover')) {
                if ($Subject->cover &&  Storage::exists($Subject->cover)) {
                    Storage::delete($Subject->cover);
                }
                $data['cover'] = $request->file('cover')->store('public/Subjects/cover');
            }

            if ($request->hasFile('introductory_video')) {
                if ($Subject->introductory_video &&  Storage::exists($Subject->introductory_video)) {
                    Storage::delete($Subject->introductory_video);
                }
                $data['introductory_video'] = $request->file('introductory_video')->store('public/Subjects/introductory_video');
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
            $Subject->update($data);
            return $this->success(new SubjectResource($Subject));
        } else {
            return $this->error(["The Subject does not exist"], "The Subject does not exist", 204);
        }
        // return $this->sendResponse(new MaterialCollection($Material), 'Material Updated successullly ');
    }

    public function deletedSubject($id)
    {
        $Subject = Subject::find($id);
        if ($Subject) {
            if ($Subject->cover && Storage::exists($Subject->cover)) {

                Storage::delete($Subject->cover);
            }
            if ($Subject->introductory_video && Storage::exists($Subject->introductory_video)) {

                Storage::delete($Subject->introductory_video);
            }
            $Subject->delete();
            return $this->success('The deletion process has been completed successfully');
        } else {
            return $this->error(["The Subject does not exist"], "The Subject does not exist", 204);
        }

        // return $this->sendResponse(new MaterialCollection($Material), 'Material Deleted successullly ');
    }
}
