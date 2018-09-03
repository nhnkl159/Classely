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
            $table->unsignedInteger('subject_id'); //NOTE: Foreign Key subjects->id
            
            $table->date('exam_date');
            $table->time('exam_start');
            $table->time('exam_end');

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
