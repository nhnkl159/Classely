<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsStudyMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students_studymaterials', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('academic_id'); //NOTE: Foreign Key academic_semesters->id
            $table->unsignedInteger('subject_id'); //NOTE: Foreign Key subjects->id
            $table->unsignedInteger('teacher_id'); //NOTE: Foreign Key user_teachers->id
            $table->json('files_path');
            $table->text('note')->nullable();
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
        Schema::dropIfExists('students_studymaterials');
    }
}
