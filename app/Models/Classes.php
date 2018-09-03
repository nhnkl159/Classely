<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'classes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'teacher_id', 'name'
    ];

    public function teacher()
    {
        return $this->belongsTo('App\Models\UsersModel', 'teacher_id', 'id');
    }
    
    public function students()
    {
        return $this->belongsToMany('App\Models\UsersModel', 'classes_students', 'class_id', 'student_id');
    }
}
