<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SwaggerController extends Controller
{

    /**
     * Show the application docs.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request): Response
    {
        return view('swagger');
    }

    /**
     * @return \OpenApi\Annotations\OpenApi
     */
    public function show(): \OpenApi\Annotations\OpenApi
    {
        return \OpenApi\scan(\dirname(__DIR__, 2));
    }

}
