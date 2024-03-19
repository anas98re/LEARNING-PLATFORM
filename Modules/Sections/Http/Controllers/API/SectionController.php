<?php

namespace Modules\Sections\Http\Controllers\API;

use Modules\Sections\Entities\Section;
use Modules\Sections\Transformers\SectionResource;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Modules\Sections\Http\Requests\GetAllSectionsRequest;

use function PHPUnit\Framework\returnValue;

class SectionController extends ApiController
{
    public function get_all_sections(GetAllSectionsRequest $request)
    {
        $section = Section::paginate($request->limit);
        if ($section->first()) {
            return SectionResource::collection($section);
        }else{
            return $this->error(["There'\s no sections"], "There'\s no sections", 204);

        }
    }

  
}
