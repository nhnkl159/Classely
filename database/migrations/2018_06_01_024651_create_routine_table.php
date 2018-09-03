<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoutineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routine', function (Blueprint $table) {
            $table->unsignedInteger('class_id'); //NOTE: Foreign Key classes->id
            $table->unsignedInteger('subject_id'); //NOTE: Foreign Key subjects->id
            $table->unsignedInteger('day_id'); //NOTE: Foreign Key days->id
            
            $table->time('time_start');
            $table->time('time_end');

            $table->string('color');

            $table->primary(['class_id', 'subject_id', 'day_id']);

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
        Schema::dropIfExists('routine');
    }
}
