<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:api')
            ->except(['store']);
    }

    /**
     * @return User[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        return User::query()->get();
    }

    /**
     * @param StoreRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws
     */
    public function store(StoreRequest $request)
    {
        return response()->json([]);
    }

}
