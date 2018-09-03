<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schools extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'schools';

    public function globalmessages()
    {
        return $this->hasMany('App\Models\GlobalMessages', 'school_id');
    }

    public function users()
    {
        return $this->hasMany('App\Models\UsersModel', 'school_id');
    }
}
