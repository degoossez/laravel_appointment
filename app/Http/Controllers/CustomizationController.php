<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\appointments_types;

class CustomizationController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('customization');
    }
    /**
     * Adjust the select appointment type with the given values
     */
    public function modifyAppointmentType($id,$description,$capacity,$length)
    {
        $appType = new appointments_types();
        return $appType->modifyAppType($id,$description,$capacity,$length);       
    }
}
