<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')
            ->except(['swagger']);
    }

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('home');
    }

    /**
     * @return \OpenApi\Annotations\OpenApi
     */
    public function swagger(): \OpenApi\Annotations\OpenApi
    {
        return \OpenApi\scan(\dirname(__DIR__) . '/Api');
    }

}
