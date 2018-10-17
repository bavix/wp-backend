<?php

namespace App\Http\Api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Spatie\QueryBuilder\QueryBuilder;

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
 * @OA\SecurityScheme(
 *   securityScheme="Bearer",
 *   type="http",
 *   scheme="bearer",
 *   name="Authorization"
 * )
 *
 * @OA\SecurityScheme(
 *     type="oauth2",
 *     name="password",
 *     securityScheme="Client Credentials",
 *     @OA\Flow(
 *         flow="clientCredentials",
 *         tokenUrl="/oauth/token",
 *         refreshUrl="/oauth/token",
 *         scopes={}
 *     )
 * )
 *
 * @OA\SecurityScheme(
 *     type="oauth2",
 *     name="password",
 *     securityScheme="Password",
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

    /**
     * @var string
     */
    protected $defaultSort;

    /**
     * @return Model
     */
    abstract protected function query(): Model;

    /**
     * @return QueryBuilder
     */
    protected function queryBuilder(): QueryBuilder
    {
        return QueryBuilder::for($this->query())
            ->defaultSort($this->defaultSort);
    }

}
