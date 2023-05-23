<?php

namespace App\Models\Enrollment;

use App\Models\Enrollment\Enum\EnrollmentTableEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    protected $table = EnrollmentTableEnum::TABLE_NAME;
}
