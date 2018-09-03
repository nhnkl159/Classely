<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subjects extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'subjects';

    public function teachers()
    {
        return $this->belongsToMany('App\Models\UsersModel', 'teachers_subjects', 'subject_id', 'teacher_id');
    }

    public function students()
    {
        return $this->belongsToMany('App\Models\UsersModel', 'students_subjects', 'student_id', 'student_id');
    }

}
