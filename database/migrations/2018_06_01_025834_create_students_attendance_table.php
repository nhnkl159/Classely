<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsAttendanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students_attendance', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('student_id'); //NOTE: Foreign Key users->id
            $table->unsignedInteger('academic_id'); //NOTE: Foreign Key academic_semesters->id
            $table->unsignedInteger('subject_id'); //NOTE: Foreign Key subjects->id
            
            $table->boolean('status');
            $table->date('att_date');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students_attendance');
    }
}
