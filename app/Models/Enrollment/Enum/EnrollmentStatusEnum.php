<?php

namespace App\Models\Enrollment\Enum;

use App\Support\Enum;

class EnrollmentStatusEnum extends Enum
{
    public const IN_PROGRESS = 'in_progress';
    public const COMPLETE = 'complete';
}
