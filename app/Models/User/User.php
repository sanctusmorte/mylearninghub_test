<?php

namespace App\Models\User;

use App\Models\User\Enum\UserTableEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $table = UserTableEnum::TABLE_NAME;
}
