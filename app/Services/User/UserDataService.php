<?php

namespace App\Services\User;

use App\Models\User\User;

class UserDataService
{
    public function getList()
    {
        return User::select('email', 'id')->get();
    }
}
