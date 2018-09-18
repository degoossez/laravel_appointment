<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class appointments_free extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'start_date','end_date','start_time','end_time', 'capacity','appointment_type','user_id',
    ];
}
