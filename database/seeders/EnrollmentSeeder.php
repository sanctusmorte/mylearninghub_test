<?php

namespace Database\Seeders;

use App\Models\Course\Enum\CourseTableEnum;
use App\Models\Enrollment\Enrollment;
use App\Models\Enrollment\Enum\EnrollmentStatusEnum;
use App\Models\User\Enum\UserTableEnum;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EnrollmentSeeder extends Seeder
{
    public function run()
    {
        $coursesIds = DB::table(CourseTableEnum::TABLE_NAME)->pluck('id')->toArray();
        $usersIds = DB::table(UserTableEnum::TABLE_NAME)->pluck('id')->toArray();

        if (empty($coursesIds) or empty($usersIds)) {
            return;
        }

        $statuses = EnrollmentStatusEnum::list();
        $insertData = [];

        foreach ($coursesIds as $coursesId) {
            $randomUsers = array_rand($usersIds, rand(20, 40));
            foreach ($randomUsers as $randomUserId) {
                if ($randomUserId !== 0) {
                    $insertData[] = [
                        'course_id' => $coursesId,
                        'user_id' => $randomUserId,
                        'status' => $statuses[array_rand($statuses)],
                        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                        'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                    ];
                }
            }
        }

        Enrollment::insert($insertData);
    }
}
