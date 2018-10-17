<?php

namespace App\Http\Api;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(title="WheelPro API", version="0.1")
 *
 * @OA\Server(
 *     url="https://dev.wheelpro.ru",
 *     description="development"
 * )
 * @OA\Server(
 *     url="https://wheelpro.ru",
 *     description="production"
 * )
 * @OA\Server(
 *     url="http://wheelpro.local",
 *     description="WheelPro Local"
 * )
 * @OA\Server(
 *     url="http://backend.local",
 *     description="Backend Local"
 * )
 *
 * @OA\Header(
 *     header="Accept",
 *     required=true,
 *     @OA\Schema(type="string"),
 *     description="the value 'application/json' should be sent"
 * )
 *
 * @OA\SecurityScheme(
 *     type="apiKey",
 *     securityScheme="bearer"
 * )
 * 
 * @OA\SecurityScheme(
 *     type="oauth2",
 *     name="password",
 *     securityScheme="password",
 *     @OA\Flow(
 *         flow="password",
 *         tokenUrl="/oauth/token",
 *         refreshUrl="/oauth/token",
 *         scopes={}
 *     )
 * )
 *
 * Class Controller
 * @package App\Http\Controllers
 */
abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
