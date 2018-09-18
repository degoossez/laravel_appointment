<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class appointments extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'appointment_type','start_date','start_time', 'end_date','end_time','cust_first_name','cust_laste_name',
        'phone','cust_email','cust_remark','user_id','gender',
    ];
}
