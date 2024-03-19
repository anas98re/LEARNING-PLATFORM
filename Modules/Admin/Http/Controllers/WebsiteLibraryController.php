<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\ApiController;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admin\Http\Requests\websiteLibraryRequest;
use Modules\Sections\Entities\WebSiteLibrary;
use Modules\Sections\Transformers\WebSiteLibraryResource;

class WebsiteLibraryController extends ApiController
{
    public function createWebsiteLibrary(websiteLibraryRequest $request)
    {
        $data = $request->all();
        $data['name'] = $request->transable == 0 ?
            ["ar" => $data['name'], "en" => ''] :
            ["ar" => $data['name'], "en" => $data['name_en']];

        $WebSiteLibrary = WebSiteLibrary::create($data);
        return $this->success(new WebSiteLibraryResource($WebSiteLibrary));
    }

    public function updatedWebsiteLibrary(websiteLibraryRequest $request, $id)
    {
        $WebSiteLibrary = websiteLibrary::find($id);
        if ($WebSiteLibrary) {
            $data = $request->all();
            $data['name'] = $request->transable == 0 ?
                ["ar" => $data['name'], "en" => ''] :
                ["ar" => $data['name'], "en" => $data['name_en']];
            $WebSiteLibrary->update($data);
            return $this->success(new WebSiteLibraryResource($WebSiteLibrary));
        } else {
            return $this->error(["The WebSite Library does not exist"], "The WebSite Library does not exist", 204);
        }
    }

    public function deletedWebsiteLibrary($id)
    {
        $websiteLibrary = websiteLibrary::find($id);
        if ($websiteLibrary) {
            $websiteLibrary->delete();
            return $this->success('The deletion process has been completed successfully');
        } else {
            return $this->error(["The website Library does not exist"], "The website Library does not exist", 204);
        }
    }
}
