<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\appointments_types;
use App\appointments;
class AppointmentsController extends Controller
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
     * getAppointmentsForSelectedDay function to provide all appointments for a given day for the current user.
     *
     */
    public function getAppointmentsForSelectedDay($selectedDay)
    {               
        if (Auth::check()){
            $user_id = Auth::user()->id;
            $appointments = \App\appointments::where('user_id','=',$user_id)->where('start_date','=',$selectedDay)->get();
            $free_appointments_html = "";
            $first=true;
            $counter = 0;
            foreach ($appointments as $fa) {
                $appType = new appointments_types();
                $appDesc = $appType->getAppointmentDescription($fa->appointment_type);   
                if($first){
                    $first=false;
                    $free_appointments_html = $free_appointments_html."<div id=\"accordion\">
                    <div class=\"card\">
                      <div class=\"card-header\" id=\"heading".$counter."\">
                        <h5 class=\"mb-0\">
                          <button class=\"btn btn-link\" data-toggle=\"collapse\" data-target=\"#collapse".$counter."\" aria-expanded=\"true\" aria-controls=\"collapse".$counter."\">
                          ". $fa->cust_first_name ." ".$fa->cust_last_name."
                          from " . $fa->start_time." until ".$fa->end_time."<br>
                          </button>
                        </h5>
                      </div>                  
                      <div id=\"collapse".$counter."\" class=\"collapse show\" aria-labelledby=\"heading".$counter."\" data-parent=\"#accordion\">
                        <div class=\"card-body\">
                        Duration: " . $fa->start_date ." : ".$fa->start_time." - ".$fa->end_date." : ".$fa->end_time."<br>
                        Appointment type: " . $appDesc[0]->description . "<br>
                        E-mail: " . $fa->cust_email . "<br>
                        Phone: " . $fa->phone . "<br>
                        Remark: " . $fa->cust_remark . "<br>                              
                        </div>
                      </div>
                    </div>";
                }
                else{
                    $free_appointments_html = $free_appointments_html."
                    <div class=\"card\">
                      <div class=\"card-header\" id=\"heading".$counter."\">
                        <h5 class=\"mb-0\">
                          <button class=\"btn btn-link\" data-toggle=\"collapse\" data-target=\"#collapse".$counter."\" aria-expanded=\"false\" aria-controls=\"collapse".$counter."\">
                          ". $fa->cust_first_name ." ".$fa->cust_last_name."
                          from " . $fa->start_time." until ".$fa->end_time."<br>
                          </button>
                        </h5>
                      </div>
                      <div id=\"collapse".$counter."\" class=\"collapse\" aria-labelledby=\"heading".$counter."\" data-parent=\"#accordion\">
                        <div class=\"card-body\">
                        Duration: " . $fa->start_date .":".$fa->start_time." - ".$fa->end_date.":".$fa->end_time."<br>
                        Appointment type: " . $appDesc[0]->description  . "<br>
                        E-mail: " . $fa->cust_email . "<br>
                        Phone: " . $fa->phone . "<br>
                        Remark: " . $fa->cust_remark . "<br>                             
                        </div>
                      </div>
                    </div>";
                }
                $counter++;
            }
            if($free_appointments_html == ""){
                return "<a>No appointments on the selected day.</a>";
            }
            else{
                $free_appointments_html = $free_appointments_html."</div>"; //add closing div for the div with id accordion
                return $free_appointments_html;
            }
            
        }
        else{
            return "You are not authenticated. Please login or contact the system administrator.";
        }
    }
    /*
    *   Functions calling this function is submitAppointmentType in the appointment_types.blade.php file.
    */    
    public function createAppointmentsType($description,$length,$capacity)
    {
        $appType = new appointments_types();
        return $appType->store($description,$length,$capacity);            
    }
    /*
    * remove the selected appointment type
    */
    public function deleteAppointmentsType($id)
    {
        $appType = new appointments_types();
        return $appType->deleteAppType($id);            
    }
    /*
    *   Function to load all the appointment types for a user based on the current user ID.
    *   This function gets called by Javascript onLoad of the appointment_types.blade.php file and when a new appointment type is added to the list.
    *   Functions calling this function are loadAppointmentTypes & submitAppointmentType in the appointment_types.blade.php file.
    */
    public function loadAppointmentTypes(){
        $appType = new appointments_types();
        $app_types = $appType->getAllAppointmentTypes();
        $app_type_html = "<ul class=\"left\">";
        foreach ($app_types as $at) {
            $app_type_html = $app_type_html."
            <li class=\"list-group-item d-flex justify-content-between align-items-center\">".
            $at->description ." - ".$at->length." - ".$at->capacity
            ."
			<div class=\"dropdown\">
			  <button class=\"btn btn-secondary dropdown-toggle\" type=\"button\" id=\"dropdownMenuButton\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
				<i class=\"fas fa-edit\"></i>
			  </button>
			  <div class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuButton\">
				<a class=\"dropdown-item\" data-toggle=\"modal\" data-target=\"#modifyAppTypeModal\" data-id=\"".$at->id."\" data-description=\"".$at->description."\" data-length=\"".$at->length."\" data-capacity=\"".$at->capacity."\">Edit</a>
				<a class=\"dropdown-item\" onclick=\"deleteAppointment(".$at->id.",'".$at->description."')\">Remove</a>
			  </div>
			</div>
            </li>";
        }
        if($app_type_html == "<ul>"){
            return "<ul><li class=\"list-group-item d-flex justify-content-between align-items-center\">
            You did not create appointment types
            <i class=\"fas fa-info-circle\"></i>
            </li></ul>";
        }
        else{
            $app_type_html = $app_type_html."</ul>"; //add end of the list
            return $app_type_html;
        }
        return ;            
    }
    /*
    *   Function to load specific data from all the appointment types for a user based on the current user ID.
    */
    public function loadAppointmentTypesForSelect(){
        $appType = new appointments_types();
        $app_types = $appType->getAllAppointmentTypes();
        return json_encode($app_types);        
    }
}
