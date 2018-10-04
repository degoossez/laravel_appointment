<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon;

class Open_times extends Model
{
    /**
     * The attributes that are mass assignable.
     * $open_times_day_php,$start_date,$end_date,$start_time,$end_time,$appointment_types_ph
     * @var array
     */
    protected $fillable = [
        'user_id', 'start_date','end_date','start_time','end_time'
        //- 1 opentime_has_days: id, open_times_id, day_of_the_week
        //- 2 opentime_has_appointmenttypes: id, open_times_id, appointment_type_id
    ];
    /**
     * Create a new open times in the database.
     *
     * @param  Request  //TODO
     * @return Response
     */
    public function store(string $open_days,string $start_date, string $end_date,string $start_time, string $end_time,string $appointment_types)
    {
        if (Auth::check()){
            $user_id = Auth::user()->id;

            $open_time = new Open_times;

            $open_time->user_id = $user_id;
            $open_time->start_date = $start_date; 
            $open_time->end_date = $end_date;
            $open_time->start_time = $start_time;
            $open_time->end_time = $end_time;        
           
            if($open_time->save()){
                $open_time_id = $open_time->id;
                //convert open_days to records in "opentime_has_days" table
                //link is created with the ID from the new created open_times
                $days_list = explode(".",$open_days);
                foreach($days_list as $day){
                    if($day != ""){
                        $opentime_days_id = DB::table('opentimes_has_days')->insertGetId( [
                            'open_times_id' => $open_time_id,
                            'day_of_the_week' => $day,
                            'created_at' =>  \Carbon\Carbon::now(), #To update the full table
                            'updated_at' => \Carbon\Carbon::now(),  #To update the full table
                        ]);
                        if(empty($opentime_days_id)){
                            return "Faild to insert the linked days in the database";
                        }
                    }
                }
                //convert appointment_types to records in "opentimes_has_apptypes" table
                $app_type_list = explode(".",$appointment_types);
                foreach($app_type_list as $apptype_id){
                    if($apptype_id != ""){
                        $opentimes_has_apptypes_id = DB::table('opentimes_has_apptypes')->insertGetId( [
                            'open_times_id' => $open_time_id,
                            'appointment_type_id' => intval($apptype_id),
                            'created_at' =>  \Carbon\Carbon::now(), #To update the full table
                            'updated_at' => \Carbon\Carbon::now(),  #To update the full table
                        ]);
                        if(empty($opentimes_has_apptypes_id)){
                            return "Faild to insert the apptypes in the database";
                        }
                    }
                }
                return "The opening times are added successfully.";
            }
            else{
                return "An error occured during the opening times creation. Please try again or contact the helpdesk.";
            }

    
        }
        else{
            return "You are not authenticated. Please login or contact the system administrator.";
        }
    }
    /**
     * Select all open times for a specific day and user
     * select id from open_times where user_id = $USER_ID;
     * select open_times_id from opentimes_has_days where id in "above query result" and day_of_the_week = $specific weekday;
     *
     * @param  Request  //TODO
     * @return Response
     */
    function getOpenTimesForDay($day_of_the_week){
        $open_times_id = DB::table('open_times')
                                    ->select('id')
                                    ->where('user_id','=',Auth::user()->id)
                                    ->get();
        $open_times_id_values = array();
        foreach($open_times_id as $r){
            $open_times_id_values[] = $r->id;
        }
        //return $open_times_id_values;
        $open_times_id_weekday = DB::table('opentimes_has_days')
                                    ->select('open_times_id')
                                    ->where('day_of_the_week','=',$day_of_the_week)
                                    ->whereIn('open_times_id',$open_times_id_values)
                                    ->get();
        $open_times_id_values = array();
        foreach($open_times_id_weekday as $r){
            $open_times_id_values[] = $r->open_times_id;
        }
        $open_times_info = DB::table('open_times')
                                    ->select('id','start_date','end_date','start_time','end_time')
                                    ->whereIn('id',$open_times_id_values)
                                    ->get();
        $html_for_day = "";
        /*
        * 24 hours time way //TODO: check in settings time notation and apply here with if statement
        */
        foreach($open_times_info as $info){
            $html_for_day .= "<li id=\"open_times_".$info->id."_".$day_of_the_week."\"" . "class=\"list-group-item\">";
            $html_for_day .= "From " . $info->start_date . " until " . $info->end_date;
            $html_for_day .= " between " . substr($info->start_time,0,-3) . "h and " . substr($info->end_time,0,-3) ."h";
            $html_for_day .= "<i onclick=\"removeOpenWeekday(" . $info->id . ",'" . $day_of_the_week .  "')\" class=\"far fa-trash-alt\"></i>";
            $html_for_day .= "</li>";
        }
        if($html_for_day == ""){
            $html_for_day = "<li class=\"list-group-item\">Closed. </li>";
        }
        return $html_for_day;
    }
    /**
     * Remove the opening times for a specific ID and weekday
     * 
     * @param  Request  //TODO
     * @return Response
     */
    function removeOpeningTimesForDay($open_times_id, $day_of_the_week){
        /*$open_times_id = DB::table('open_times')
                                    ->select('id')
                                    ->where('user_id','=',Auth::user()->id)
                                    ->get();
        */
        $deleted = DB::table('opentimes_has_days')
                    ->where('open_times_id','=',$open_times_id)
                    ->where('day_of_the_week','=',$day_of_the_week)
                    ->delete();
        if($deleted){
            if(DB::table('opentimes_has_days')->where('open_times_id',$open_times_id)->exists()){
                return "Opening time deleted successfully";
            }
            else{
                if(DB::table('open_times')->where('id','=',$open_times_id)->delete()){
                    return "Opening time deleted successfully";
                }
                else{
                    /**
                     * When the delete of the open_times is failed, the day of the week has to be recovered.
                     */
                    $opentime_days_id = DB::table('opentimes_has_days')->insertGetId( [
                        'open_times_id' => $open_times_id,
                        'day_of_the_week' => $day_of_the_week,
                        'created_at' =>  \Carbon\Carbon::now(), #To update the full table
                        'updated_at' => \Carbon\Carbon::now(),  #To update the full table
                    ]);
                    if(empty($opentime_days_id)){
                        return "The deletion failed & the recovery of the opening day failed.";
                    }                    
                    return "The deletion failed.";
                }
            }
            
        }
        else{
            return "The deletion failed.";
        }
    }
}
