<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class appointments_types extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description','length','capacity', 'user_id',
    ];
    /**
     * Create a new appointment type in the database.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(string $description,int $length, int $capacity)
    {
        if (Auth::check()){
            $user_id = Auth::user()->id;

            $app_type = new appointments_types;

            $app_type->description = $description;
            $app_type->length = $length;
            $app_type->capacity = $capacity;
            $app_type->user_id = $user_id;

            if(\App\appointments_types::where('user_id','=',$user_id)->where('description','=',$description)->exists()){
                return "It is not allowed to create 2 appointment types with the same description.";
            }
            else{
                if($app_type->save()){
                    return "The appointment type is successfully created.";
                }
                else{
                    return "An error occured during the appointment type creation. Please try again or contact the helpdesk.";
                }
            }
        }
        else{
            return "You are not authenticated. Please login or contact the system administrator.";
        }
    }
        /**
     * Remove an appointment type based on the appointment type id
     *
     * @return Response
     */
    public function deleteAppType(int $id)
    {
        if (Auth::check()){
            $user_id = Auth::user()->id;
            if(\App\appointments_types::where('id','=',$id)->delete()){
                return "successfully deleted";
            }
            else{
                return "the deletion failed. Please try again or contact the system administrator.";
            }
        }
        else{
            return "You are not authenticated. Please login or contact the system administrator.";
        }
    }
    /*
    *   Get all the appointment types for a specific user.
    */
    public function getAllAppointmentTypes(){
        if (Auth::check()){
            return \App\appointments_types::where('user_id','=',Auth::user()->id)->get();
        }
        else{
            return "You are not authenticated. Please login or contact the system administrator.";
        }
    }
    /*
    *   Get all the appointment description for a specific user and appointment type.
    */
    public function getAppointmentDescription(int $requestedID){
        if (Auth::check()){
            return \App\appointments_types::select('description')->where('user_id','=',Auth::user()->id)->where('id','=',$requestedID)->get();
        }
        else{
            return "You are not authenticated. Please login or contact the system administrator.";
        }
    }
    /**
     * Modify the appointmenttype provided with the specific values
     */
    public function modifyAppType(int $typeID, string $description, int $capacity, int $length){
        if (Auth::check()){
            $user_id = Auth::user()->id;
            if(\App\appointments_types::find($typeID)){
                $appType = \App\appointments_types::find($typeID);
                $appType->description = $description;
                $appType->length = $length;
                $appType->capacity = $capacity;
                if($appType->save()){
                    return "successfully modified";
                }
                else{
                    return "The update failed. Please try again or contact the system administrator.";
                }
            }
            else{
                return "We could not find your appointment. Please try again or contact the system administrator.";
            }
        }
        else{
            return "You are not authenticated. Please login or contact the system administrator.";
        }
    }
}
