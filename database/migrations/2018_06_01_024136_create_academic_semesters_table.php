<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAcademicSemestersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academic_semesters', function (Blueprint $table) {
            $table->unsignedInteger('school_id'); //NOTE: Foreign Key schools->id
            $table->timestamp('semester_1_start')->nullable();
            $table->timestamp('semester_2_start')->nullable();
            $table->timestamp('semester_2_end')->nullable();
            $table->primary('school_id');
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
        Schema::dropIfExists('academic_semesters');
    }
}
