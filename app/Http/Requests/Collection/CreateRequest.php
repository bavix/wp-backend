<?php

namespace App\Http\Requests\Collection;

use App\Enums\PermissionEnum;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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

        return $user && $user->can(PermissionEnum::COLLECTIONS_CREATE);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [];
    }

}
