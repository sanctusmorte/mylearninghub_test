<?php

namespace App\Constants;

use App;


class ResponseEnum extends App\Support\Enum
{
    public const RESPONSE_STATUS_SUCCESS = 'success';
    public const RESPONSE_STATUS_INFO = 'info';
    public const RESPONSE_STATUS_ERROR = 'error';

    public const EDIT_ERROR = 'edit_error';
    public const DELETE_ERROR = 'delete_error';
    public const CREATE_ERROR = 'create_error';
}
