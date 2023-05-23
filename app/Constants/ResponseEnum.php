<?php

namespace App\Constants;

use App;


class ResponseEnum extends App\Support\Enum
{
    public const RESPONSE_STATUS_SUCCESS = 'success';
    public const RESPONSE_STATUS_INFO = 'info';
    public const RESPONSE_STATUS_ERROR = 'error';
}
