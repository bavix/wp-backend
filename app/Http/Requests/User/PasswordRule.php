<?php

namespace App\Http\Requests\User;

use Illuminate\Contracts\Validation\Rule;

class PasswordRule implements Rule
{

    /**
     * @var string
     */
    protected $message;

    /**
     * @param string $value
     *
     * @return bool
     */
    protected function lowercase(string $value): bool
    {
        $this->message = \trans('validation.password.lowercase');

        return \preg_match('~[a-z]~', $value);
    }

    /**
     * @param string $value
     *
     * @return bool
     */
    protected function uppercase(string $value): bool
    {
        $this->message = \trans('validation.password.uppercase');

        return \preg_match('~[A-Z]~', $value);
    }

    /**
     * @param string $value
     *
     * @return bool
     */
    protected function digits(string $value): bool
    {
        $this->message = \trans('validation.password.digits');

        return \preg_match('~\d~', $value);
    }

    /**
     * @param string $attribute
     * @param mixed  $value
     *
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        $lowercase = $this->lowercase($value);
        $uppercase = $this->uppercase($value);
        $digits    = $this->digits($value);

        return
            ($lowercase && $uppercase) ||
            ($lowercase && $digits) ||
            ($uppercase && $digits);
    }

    /**
     * @return string
     */
    public function message(): string
    {
        return $this->message;
    }

}
