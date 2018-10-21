<?php

namespace App\Http\Rules;

use Illuminate\Contracts\Validation\Rule;

class PasswordRule implements Rule
{

    /**
     * @var string
     */
    protected $message;

    /**
     * @param string $attribute
     * @param mixed $value
     *
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        return
            ($this->lowercase($value) && $this->uppercase($value)) ||
            ($this->lowercase($value) && $this->digits($value)) ||
            ($this->uppercase($value) && $this->digits($value));
    }

    /**
     * @param string $value
     *
     * @return bool
     */
    protected function lowercase(string $value): bool
    {
        $this->message = \trans('whlpro.password.lowercase');

        return \preg_match('~[a-z]~', $value);
    }

    /**
     * @param string $value
     *
     * @return bool
     */
    protected function uppercase(string $value): bool
    {
        $this->message = \trans('whlpro.password.uppercase');

        return \preg_match('~[A-Z]~', $value);
    }

    /**
     * @param string $value
     *
     * @return bool
     */
    protected function digits(string $value): bool
    {
        $this->message = \trans('whlpro.password.digits');

        return \preg_match('~\d~', $value);
    }

    /**
     * @return string
     */
    public function message(): string
    {
        return $this->message;
    }

}
