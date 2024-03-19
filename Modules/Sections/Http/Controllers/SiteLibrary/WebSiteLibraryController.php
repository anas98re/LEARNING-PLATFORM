<?php

namespace Modules\Sections\Http\Controllers\SiteLibrary;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Sections\Entities\WebSiteLibrary;
use Modules\Sections\Transformers\WebSiteLibraryResource;
use App\Http\Controllers\ApiController;
use Modules\Sections\Http\Requests\GetWebsiteLibraryInfoRequest;

class WebSiteLibraryController extends ApiController
{
    public function get_website_library_info(GetWebsiteLibraryInfoRequest $request)
    {
        $website_library = WebSiteLibrary::paginate($request->limit)();
        if ($website_library->first()) {
            return  $this->success(WebSiteLibraryResource::collection($website_library), 200);
        } else {
            return  $this->error(['No such data'], 'No such data', 204);
        }
    }
}
