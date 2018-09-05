<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsBehaviourTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students_behaviour', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('student_id'); //NOTE: Foreign Key users->id
            $table->unsignedInteger('academic_id'); //NOTE: Foreign Key academic_semesters->id
            $table->unsignedInteger('teacher_id'); //NOTE: Foreign Key user_teachers->user_id
            $table->unsignedInteger('behaviour_type'); //NOTE: Foreign Key behaviour_types->id
            
            $table->text('note');
            $table->date('behav_date');
            $table->boolean('is_justified');
            $table->text('justified_note');
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
        Schema::dropIfExists('students_behaviour');
    }
}
