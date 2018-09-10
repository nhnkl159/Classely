<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsBagrutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students_bagruts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('academic_id'); //NOTE: Foreign Key academic_semesters->id
            $table->unsignedInteger('student_id'); //NOTE: Foreign Key users->id
            $table->unsignedInteger('subject_id'); //NOTE: Foreign Key subjects->id
            $table->string('questionnaire_name')->nullable();
            $table->bigInteger('questionnaire_num')->nullable();
            $table->bigInteger('questionnaire_main')->nullable();

            $table->integer('submit_grade')->nullable();
            $table->integer('bagrut_grade')->nullable();
            $table->boolean('has_project');
            $table->integer('project_grade')->nullable();
            $table->integer('final_grade')->nullable();
            $table->text('note');
            $table->timestamp('submit_exam_date')->nullable();
            $table->timestamp('bagrut_date')->nullable();
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
        Schema::dropIfExists('students_bagruts');
    }
}
