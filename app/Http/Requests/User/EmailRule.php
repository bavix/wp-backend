<?php

namespace App\Http\Requests\User;

use App\Models\User\Contact;
use Illuminate\Contracts\Validation\Rule;

class EmailRule implements Rule
{

    /**
     * @param string $attribute
     * @param mixed  $value
     *
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        return !Contact::query()
            ->where('type', Contact::TYPE_EMAIL)
            ->where('value', $value)
            ->exists();
    }

    /**
     * @return string
     */
    public function message(): string
    {
        return trans('validation.unique');
    }

}
