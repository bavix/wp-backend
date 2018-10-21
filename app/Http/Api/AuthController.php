<?php

namespace App\Http\Api;

use App\Http\Requests\User\ForgetRequest;
use App\Models\Social;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\Http\Requests\User\CreateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Laravel\Passport\PersonalAccessTokenResult;
use Laravel\Socialite\AbstractUser;
use Laravel\Socialite\Facades\Socialite;

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
        event(new Registered($user));
        return response($user, 201);
    }

    /**
     * @param Request $request
     * @param string $provider
     * @return PersonalAccessTokenResult
     */
    public function social(Request $request, string $provider): PersonalAccessTokenResult
    {
        // github 0b65bba5eaeba0acbf7c7de9d21064648cd35557
        $driver = Socialite::driver($provider);
        $token = $request->input('token');
        $secret = $request->input('secret');
        $scopes = $request->input('scopes', []);

        try {
            if ($secret) {
                $providerUser = $driver->userFromTokenAndSecret($token, $secret);
            } else {
                $providerUser = $driver->userFromToken($token);
            }
        } catch (\Throwable $throwable) {
            abort(401, $throwable->getMessage());
        }

        return $this->registred($provider, $providerUser)
            ->createToken($provider, $scopes);
    }

    /**
     * @param AbstractUser $user
     * @return string
     */
    protected function loginUnique(AbstractUser $user): string
    {
        return !$user->nickname || User::whereLogin($user->nickname)->first() ?
            Str::random() : $user->nickname;
    }

    /**
     * @param AbstractUser $providerUser
     * @return array
     */
    protected function providerData(AbstractUser $providerUser): array
    {
        return [
            'login' => $this->loginUnique($providerUser),
            'name' => $providerUser->name,
            'password' => Str::random(),
            'email_verified_at' => $providerUser->email ?
                Carbon::now() : null,
        ];
    }

    /**
     * @param User $user
     * @return User
     */
    protected function autoVerified(User $user): User
    {
        if ($user->email && !$user->email_verified_at) {
            $user->email_verified_at = Carbon::now();
            $user->save();
        }

        return $user;
    }

    /**
     * @param string $provider
     * @param AbstractUser $providerUser
     * @return User
     */
    protected function registred(string $provider, AbstractUser $providerUser): User
    {
        try {
            return Social::query()
                ->where('provider', $provider)
                ->where('provider_id', $providerUser->id)
                ->firstOrFail()
                ->user;

        } catch (\Throwable $throwable) {

            if ($providerUser->email) {
                $user = User::firstOrCreate(
                    ['email' => $providerUser->email],
                    $this->providerData($providerUser)
                );
            } else {
                $user = User::create($this->providerData($providerUser));
            }
            
            Social::create([
                'provider' => $provider,
                'provider_id' => $providerUser->id,
                'user_id' => $user->id,
            ]);

            return $this->autoVerified($user);
        }
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
        return response(['message' => trans($response)], 202);
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
        return response(['message' => trans($response)], 422);
    }

}
