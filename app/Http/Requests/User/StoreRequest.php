<?php

namespace App\Http\Requests\User;

class StoreRequest extends UpdateRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return !parent::authorize();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return \array_merge_recursive(parent::rules(), [
            'login' => ['required', 'string', 'min:3', 'max:32'],
            'email' => ['required', 'email'],
            'password' => ['required', 'min:5', new PasswordRule()],
        ]);
    }

}
