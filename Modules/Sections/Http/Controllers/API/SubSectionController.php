<?php

namespace Modules\Sections\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Sections\Entities\SubSection;
use Modules\Sections\Transformers\SubSectionResource;
use App\Http\Controllers\ApiController;
use Modules\Sections\Http\Requests\GetSubSectionsBySectionIdRequest;

class SubSectionController extends ApiController
{
    public function get_sub_sections_by_section_id(GetSubSectionsBySectionIdRequest $request, $id)
    {
        $sub_sections = SubSection::where('section_id', $id)->with('section')
            ->latest('created_at')->paginate($request->limit);
        if ($sub_sections->first()) {
            return $this->success(SubSectionResource::collection($sub_sections), 200);
        } else {
            return $this->error(["there is no section with id " . $id], "there is no section with id ", 204);
        }
    }
}
