<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Homework extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'students_homework';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];
}
