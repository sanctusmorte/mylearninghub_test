<?php

namespace App\Models\Course;

use App\Models\Course\Enum\CourseTableEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $table = CourseTableEnum::TABLE_NAME;
}
