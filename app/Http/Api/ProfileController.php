<?php

namespace App\Http\Api;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    /**
     * @param Request $request
     * @return UserResource
     */
    public function show(Request $request): UserResource
    {
        return new UserResource(
            $this->queryBuilder()
                ->allowedIncludes('image', 'roles')
                ->find($request->user()->id)
        );
    }

    /**
     * @return Builder
     */
    protected function query(): Builder
    {
        return User::whereEnabled(true);
    }

}
