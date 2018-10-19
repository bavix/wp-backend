<?php

namespace App\Http\Api;

use App\Http\Requests\User\ForgetRequest;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\Http\Requests\User\CreateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class AuthController
 * @package App\Http\Api
 */
class AuthController extends BaseController
{

    use SendsPasswordResetEmails;

    /**
     * @param CreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function register(CreateRequest $request): Response
    {
        $user = User::create($request->validated());
        $response = response($user);

        if ($user) {
            $response->setStatusCode(201);
        }

        return $response;
    }

    public function social()
    {
        // todo: socialite
    }

    /**
     * @param ForgetRequest $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function forgot(ForgetRequest $request)
    {
        return $this->sendResetLinkEmail($request);
    }

    /**
     * Get the response for a successful password reset link.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetLinkResponse(Request $request, $response)
    {
        return response(['message' => trans($response), 'error' => []], 202);
    }

    /**
     * Get the response for a failed password reset link.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        return response(['message' => trans($response), 'error' => []], 422);
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        // todo
    }

}
