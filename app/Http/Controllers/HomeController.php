<?php

namespace App\Http\Controllers;

use App\Models\User\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{

//    public function show(Request $request)
//    {
//        return Socialite::driver('github')->redirect();
//    }
//
//    public function callback(Request $request)
//    {
//        return \json_encode(Socialite::driver('github')->user());
//    }

    public function show(Request $request)
    {
        /**
         * @var $first User
         * @var $second User
         */
        $first = User::query()->first();
        $second = User::query()->offset(1)->first();

        $first->follow($second);

        return $first->load('followers');
    }

}
