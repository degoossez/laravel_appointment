<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class License extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'accounttype','paid','start_date','end_date', 'user_id',
    ];
    /**
     * Create a new license instance.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(int $user_id)
    {
        // Validate the request...
        $today = Carbon::now();
        $today->toDateString();

        $license = new License;

        $license->account_type = 'trail';
        $license->paid = $today;
        $license->start_date = $today;
        $license->end_date = $today->addMonths(3);
        $license->user_id = $user_id;

        $license->save();
    }
}
