<?php

namespace App\Http\Controllers;

use App\Http\Requests\Swagger\ViewRequest;
use OpenApi\Annotations\OpenApi;

class SwaggerController extends Controller
{

    /**
     * @param ViewRequest $request
     * @return \Illuminate\View\View
     */
    public function index(ViewRequest $request)
    {
        return view('swagger');
    }

    /**
     * @param ViewRequest $request
     * @return OpenApi
     */
    public function show(ViewRequest $request): OpenApi
    {
        return \OpenApi\scan(\dirname(__DIR__, 2));
    }

}
