<?php

namespace Modules\Sections\Http\Controllers\SiteLibrary;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Sections\Entities\Book;
use Modules\Sections\Transformers\BookResource;
use App\Http\Controllers\ApiController;
use Modules\Sections\Http\Requests\GetBooksByWebsiteLibraryIdRequest;

class BookController extends ApiController
{
    public function get_books_by_website_library_id(GetBooksByWebsiteLibraryIdRequest $request, $id)
    {
        $book = Book::where('website_library_id', $id)->paginate($request->limit);
        if ($book->first()) {
            return  $this->success(BookResource::collection($book), 200);
        } else {
            return $this->error(["The sit library does not exist"], "The sit library does not exist", 204);
        }
    }
}
