<?php

namespace App\Models\Enrollment;

use App\Models\Course\Course;
use App\Models\Enrollment\Enum\EnrollmentTableEnum;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    protected $table = EnrollmentTableEnum::TABLE_NAME;

    public function course()
    {
        return $this->hasOne(Course::class, 'id', 'course_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
