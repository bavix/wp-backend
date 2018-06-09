<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     *
     * @throws
     */
    public function report(Exception $exception): void
    {
        parent::report($exception);
    }

    /**
     * @inheritdoc
     */
    public function render($request, Exception $exception): Response
    {
        return parent::render($request, $exception);
    }

}
