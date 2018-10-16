<?php

namespace App\Http\Requests\User;

use App\Http\Rules\PasswordRule;
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
        return !$this->user();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'login' => ['required', 'unique:users', 'string', 'min:3', 'max:32'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:5', new PasswordRule()],
        ];
    }

}
