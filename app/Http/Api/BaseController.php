<?php

namespace App\Http\Api;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller;

/**
 * Class BaseController
 * @package App\Http\Controllers
 */
abstract class BaseController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
