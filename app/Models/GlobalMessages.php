<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class GlobalMessages extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'global_messages';

    public function school()
    {
        return $this->belongsTo('App\models\Schools');
    }

}
