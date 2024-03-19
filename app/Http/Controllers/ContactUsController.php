<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactUsRequest;
use App\Models\ContactUs;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class ContactUsController extends ApiController
{
    public function add_conact_us_information(ContactUsRequest $request)
    {
        $data = $request->all();
        ContactUs::create($data);
        return $this->success($data, 200);
    }
}
