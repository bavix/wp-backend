<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenApi\Annotations\OpenApi;

class SwaggerController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('swagger');
    }

    /**
     * @return OpenApi
     */
    public function show(): OpenApi
    {
        return \OpenApi\scan(\dirname(__DIR__, 2));
    }

}
