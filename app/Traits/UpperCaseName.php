<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait UpperCaseName
{

    /**
     * @param string $name
     * @return string
     */
    public function getNameAttribute(?string $name): string
    {
        return Str::upper($name);
    }

    /**
     * @param string $name
     */
    public function setNameAttribute(string $name): void
    {
        $this->attributes['name'] = $this->getNameAttribute($name);
    }

}
