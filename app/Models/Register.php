<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Register extends Authenticatable
{
    use Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    public $timestamps = false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'school_id', 'username', 'password', 'details', 'reset_key',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'role_id', 'pivot'
    ];

    public function classes_students()
    {
         return $this->belongsToMany('App\models\Classes', 'classes_students', 'student_id', 'class_id');
    }

    public function students_subjects()
    {
         return $this->belongsToMany('App\models\Classes', 'students_subjects', 'student_id', 'subject_id');
    }
}
