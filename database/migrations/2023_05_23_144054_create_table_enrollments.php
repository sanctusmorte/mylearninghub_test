<?php

use App\Models\Course\Enum\CourseTableEnum;
use App\Models\Enrollment\Enum\EnrollmentStatusEnum;
use App\Models\Enrollment\Enum\EnrollmentTableEnum;
use App\Models\User\Enum\UserTableEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(EnrollmentTableEnum::TABLE_NAME, function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->enum('status', EnrollmentStatusEnum::list());
            $table->timestamps();

            $table->foreign('course_id')->references('id')->on(CourseTableEnum::TABLE_NAME)->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on(UserTableEnum::TABLE_NAME)->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists(EnrollmentTableEnum::TABLE_NAME);
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
};
