<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamsScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams_schedule', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('exam_type'); //NOTE: Foreign Key exams_types->id
            $table->unsignedInteger('academic_id'); //NOTE: Foreign Key academic_semesters->id
            $table->unsignedInteger('subject_id'); //NOTE: Foreign Key subjects->id
            
            $table->timestamp('exam_start')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('exam_end')->default(DB::raw('CURRENT_TIMESTAMP'));
            
            $table->string('color')->default('#3498db');

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
        Schema::dropIfExists('exams_schedule');
    }
}
