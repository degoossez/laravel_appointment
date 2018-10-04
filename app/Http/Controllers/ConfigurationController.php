<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Open_times;

class ConfigurationController extends Controller
{
    /**
     * Create a new controller instance.
     * 
     * @return void
     */
    public function __construct()
    {
        //Protect that only users with role company can get to this page
        $this->middleware(['role:company']);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('configuration');
    }
    /*
    *   Function to add a new "opening times" for a specific user.
    *   This function gets called by Javascript in the bootstrap Modal "add_open_times.php"
    */
    public function addOpeningTimes($open_times_day_php,$start_date,$end_date,$start_time,$end_time,$appointment_types_php){
        $openTime = new Open_times();
        $start_date = $this->dateToYYYYMMDD($start_date);
        $end_date = $this->dateToYYYYMMDD($end_date);
        return $openTime->store($open_times_day_php,$start_date,$end_date,$start_time,$end_time,$appointment_types_php);   
    }
    /*
    * Changes date from DD-MM-YYYY to YYYY-MM-DD
    */
    public function dateToYYYYMMDD($dateDDMMYYYY){
        $date_split = explode("-",$dateDDMMYYYY);
        $dateYYYYMMDD = $date_split[2]."-".$date_split[1]."-".$date_split[0];
        return $dateYYYYMMDD;
    }
    /**
     * Function to get the opening times of a specific date which is specified in the argument
     * This is used in the configuration view 
     */
    static public function getOpenTimesForDay($day_of_the_week){
        $openTime = new Open_times();
        return $openTime->getOpenTimesForDay($day_of_the_week);
    }
    /**
     * Function to delete the opening times of a specific date which is specified in the argument with an ID and day
     * This is used in the configuration view 
     */
    public function removeOpeningTimesForDay($open_times_id, $day_of_the_week){
        $openTime = new Open_times();
        return $openTime->removeOpeningTimesForDay($open_times_id,$day_of_the_week);
    }
}
