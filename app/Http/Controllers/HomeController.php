<?php

namespace App\Http\Controllers;

use App\Http\Resources\BrandCollection;
use App\Models\Brand;
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
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::query()
            ->withCount('likes', 'favorites')
            ->paginate();

        return new BrandCollection($brands);

//        return view('home');
    }

    /**
     * @return \OpenApi\Annotations\OpenApi
     */
    public function swagger(): \OpenApi\Annotations\OpenApi
    {
        return \OpenApi\scan(__DIR__);
    }

}
