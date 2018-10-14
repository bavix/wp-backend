<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class DashController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     *
     * @return View
     */
    public function index(Request $request): View
    {
        return view('dash');
    }

}
