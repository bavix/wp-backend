<?php

namespace App\Http\Controllers;

use App\Models\Social\Comment;
use App\Models\Social\Favorite;
use App\Models\Social\Like;
use App\Models\Wheel\Wheel;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

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
        return Wheel::query()
            ->withCount([
                'commented as commented',
                'favored as favored',
                'liked as liked',
            ])
            ->get();
    }

}
