<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students_exams', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('academic_id'); //NOTE: Foreign Key academic_semesters->id
            $table->unsignedInteger('exam_type'); //NOTE: Foreign Key exams_types->id
            $table->unsignedInteger('student_id'); //NOTE: Foreign Key users->id
            $table->unsignedInteger('subject_id'); //NOTE: Foreign Key subjects->id
            $table->integer('current_grade');
            $table->integer('prev_grade')->nullable();
            $table->text('note');
            $table->timestamp('exam_date');
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
        Schema::dropIfExists('students_exams');
    }
}
