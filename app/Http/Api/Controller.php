<?php

namespace App\Http\Api;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

/**
 * @OA\Info(title="WheelPro API", version="0.1")
 * @OA\PathItem(path="/api/")
 * @OA\Server(
 *     url="https://dev.wheelpro.ru",
 *     description="development"
 * )
 * @OA\Server(
 *     url="https://wheelpro.ru",
 *     description="production"
 * )
 * @OA\Header(
 *     header="Accept",
 *     required=true,
 *     @OA\Schema(type="string"),
 *     description="the value 'application/json' should be sent"
 * )
 *
 * Class Controller
 * @package App\Http\Controllers
 */
abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
