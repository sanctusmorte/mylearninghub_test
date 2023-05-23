<?php

namespace App\Rules;

use Illuminate\Validation\Rules\Enum as IlluminateEnumRule;

class Enum extends IlluminateEnumRule
{
    public function passes($attribute, $value): bool
    {
        if (is_null($value)) {
            return false;
        }

        $isEnumClass = is_subclass_of($this->type, \App\Support\Enum::class);

        if (! $isEnumClass) {
            return false;
        }

        return $this->type::has($value);
    }
}
