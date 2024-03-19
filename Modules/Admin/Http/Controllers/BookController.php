<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\ApiController;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Modules\Admin\Http\Requests\bookRequest;
use Modules\Sections\Entities\Book;
use Modules\Sections\Transformers\BookResource;

class BookController extends ApiController
{
    public function createBook(bookRequest $request)
    {
        $data = $request->all();
        if ($request->hasFile('pdf_path')) {
            $data['pdf_path'] = $request->file('pdf_path')->store('public/Book');
        }
        $data['title'] = $request->transable == 0 ?
            ["ar" => $data['title'], "en" => ''] :
            ["ar" => $data['title'], "en" => $data['title_en']];
        $book = Book::create($data);
        return $this->success(new BookResource($book));
    }


    public function updatedBook(bookRequest $request, $id)
    {
        $Book = Book::find($id);
        if ($Book) {
            $data = $request->all();
            $data['title'] = $request->transable == 0 ?
                ["ar" => $data['title'], "en" => ''] :
                ["ar" => $data['title'], "en" => $data['title_en']];

            if ($request->hasFile('pdf_path')) {
                if ($Book->pdf_path &&  Storage::exists($Book->pdf_path)) {
                    Storage::delete($Book->pdf_path);
                }
                $data['pdf_path'] = $request->file('pdf_path')->store('public/Book');
            }
            $Book->update($data);
            return $this->success(new BookResource($Book));
        } else {
            return $this->error(["The Book does not exist"], "The Book does not exist", 204);
        }
    }

    public function deletedBook($id)
    {
        $Book = Book::find($id);
        if ($Book) {
            if ($Book->pdf_path && Storage::exists($Book->pdf_path)) {

                Storage::delete($Book->pdf_path);
            }
            $Book->delete();
            return $this->success('The deletion process has been completed successfully');
        } else {
            return $this->error(["The Book does not exist"], "The Book does not exist", 204);
        }
    }
}
