<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreRequest;
use App\Models\User\User;

class UserController extends Controller
{

    /**
     * @return User[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index() {
        return User::all();
    }

    /**
     * @param StoreRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws
     */
    public function store(StoreRequest $request) {
        $user = new User();
        $user->fill($request->validated());
        $user->saveOrFail();

        return response()
            ->json($user)
            ->setStatusCode(201);
    }

}
