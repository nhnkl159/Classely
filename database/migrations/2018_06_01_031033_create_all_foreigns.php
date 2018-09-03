<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAllForeigns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Users Table
        Schema::table('users', function (Blueprint $table) 
        {
            $table->foreign('school_id')->references('id')->on('schools')->onDelete("cascade");
            $table->foreign('role_id')->references('id')->on('users_roles')->onDelete("cascade");
        });

        //Users Teachers Table
        Schema::table('user_teachers', function (Blueprint $table) 
        {
            $table->foreign('user_id')->references('id')->on('users')->onDelete("cascade");
            $table->foreign('staff_type')->references('id')->on('teachers_types')->onDelete("cascade");
        });

        //Users Parents Table
        Schema::table('students_parents', function (Blueprint $table) 
        {
            $table->foreign('user_id')->references('id')->on('users')->onDelete("cascade"); //Parent
            $table->foreign('student_id')->references('id')->on('users')->onDelete("cascade"); //Student
        });

        //Classes Table
        Schema::table('classes', function (Blueprint $table) 
        {
            $table->foreign('teacher_id')->references('user_id')->on('user_teachers')->onDelete("cascade");
        });


        //Classes Students Table
        Schema::table('classes_students', function (Blueprint $table) 
        {
            $table->foreign('class_id')->references('id')->on('classes')->onDelete("cascade");
            $table->foreign('student_id')->references('id')->on('users')->onDelete("cascade");
        });

        //Teachers Subjects Table
        Schema::table('teachers_subjects', function (Blueprint $table) 
        {
            $table->foreign('teacher_id')->references('user_id')->on('user_teachers')->onDelete("cascade");
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete("cascade");
        });
        
        //Class Subjects Table
        Schema::table('class_subjects', function (Blueprint $table) 
        {
            $table->foreign('class_id')->references('id')->on('classes')->onDelete("cascade");
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete("cascade");
        });


        //Class Subjects Table
        Schema::table('students_exams', function (Blueprint $table) 
        {
            $table->foreign('exam_type')->references('id')->on('exams_types')->onDelete("cascade");
            $table->foreign('student_id')->references('id')->on('users')->onDelete("cascade");
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete("cascade");
        });

        //Academic Semesters Table
        Schema::table('academic_semesters', function (Blueprint $table) 
        {
            $table->foreign('school_id')->references('id')->on('schools')->onDelete("cascade");
        });

        //Students Subjects Table
        Schema::table('students_subjects', function (Blueprint $table) 
        {
            $table->foreign('student_id')->references('id')->on('users')->onDelete("cascade");
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete("cascade");
        });

        //Routine Table
        Schema::table('routine', function (Blueprint $table) 
        {
            $table->foreign('class_id')->references('id')->on('classes')->onDelete("cascade");
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete("cascade");
            $table->foreign('day_id')->references('id')->on('days')->onDelete("cascade");
        });

        //Exams Schedule Table
        Schema::table('exams_schedule', function (Blueprint $table) 
        {
            $table->foreign('exam_type')->references('id')->on('exams_types')->onDelete("cascade");
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete("cascade");
        });

        //Students Attendance Table
        Schema::table('students_attendance', function (Blueprint $table) 
        {
            $table->foreign('student_id')->references('id')->on('users')->onDelete("cascade");
            $table->foreign('class_id')->references('id')->on('classes')->onDelete("cascade");
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete("cascade");
        });

        //Students Behaviour Table
        Schema::table('students_behaviour', function (Blueprint $table) 
        {
            $table->foreign('student_id')->references('id')->on('users')->onDelete("cascade");
            $table->foreign('teacher_id')->references('id')->on('user_teachers')->onDelete("cascade");
            $table->foreign('behaviour_type')->references('id')->on('behaviour_types')->onDelete("cascade");
        });

        //Global messages Table
        Schema::table('global_messages', function (Blueprint $table) 
        {
            $table->foreign('school_id')->references('id')->on('schools')->onDelete("cascade");
        });

        //Temp Users Table
        Schema::table('tempusers', function (Blueprint $table) 
        {
            $table->foreign('school_id')->references('id')->on('schools')->onDelete("cascade");
            $table->foreign('role_id')->references('id')->on('users_roles')->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
