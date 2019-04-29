<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param string $class
     * @param string $field
     * @return callable
     * @deprecated
     */
    protected function ajaxSelect(string $class, string $field = 'name'): callable
    {
        return function ($id) use ($class, $field) {
            $model = $class::find($id);
            if ($model) {
                return [$id => $model->$field];
            }
        };
    }

}
