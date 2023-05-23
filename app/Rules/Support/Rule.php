<?php

namespace App\Rules\Support;

use App\Rules\Enum;
use Illuminate\Validation\Rule as IlluminateRuleFactory;

class Rule extends IlluminateRuleFactory
{
    public static function enum($type): Enum
    {
        return new Enum($type);
    }
}
