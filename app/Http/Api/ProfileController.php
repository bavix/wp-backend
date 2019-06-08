<?php

namespace App\Http\Api;

use App\Http\Requests\User\ChangePasswordRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    /**
     * @param Request $request
     * @return Response
     */
    public function logout(Request $request): Response
    {
        $request->user()->token()->revoke();
        return response()->noContent();
    }

    /**
     * @param Request $request
     * @return UserResource
     */
    public function show(Request $request): UserResource
    {
        return new UserResource(
            $this->queryBuilder()
                ->allowedIncludes('image', 'settings')
                ->find($request->user()->id)
        );
    }

    /**
     * @param ChangePasswordRequest $request
     * @return Response
     */
    public function changePassword(ChangePasswordRequest $request): Response
    {
        /**
         * @var User $user
         */
        $user = $request->user();
        $user->password = Hash::make($request->input('password'));

        if ($user->save()) {
            return response(['message' => trans('profile.changePassword')]);
        }

        return response(['message' => trans('profile.changePasswordFail')], 422);
    }


    /**
     * @param Request $request
     * @return array|null
     */
    public function verifiedEmail(Request $request)
    {
        /**
         * @var $user User
         */
        $user = $request->user();
        $code = 409;
        $content = ['message' => trans('verify.verified')];

        if (!$user->hasVerifiedEmail()) {
            $user->sendEmailVerificationNotification();
            $content['message'] = trans('verify.notify');
            $code = 202;
        }

        return response($content, $code);
    }

    /**
     * @return Builder
     */
    protected function query(): Builder
    {
        return User::whereEnabled(true);
    }

}
