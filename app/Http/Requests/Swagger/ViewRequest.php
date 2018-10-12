<?php

namespace App\Http\Requests\Swagger;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class ViewRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        /**
         * @var $user User
         */
        $user = $this->user();

        return $user && $user->can('swagger.view');
    }

}
