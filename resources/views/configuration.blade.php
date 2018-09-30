<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Configuration</title>
    @include('layouts.header')
    @include('Modals/modify_app_type')

    <link href="{{ asset('css/datepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-clockpicker.min.css') }}" rel="stylesheet">

    <!-- including select2 via cdn, more info on https://select2.org/ -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
</head>
<body>
    <!-- Included the navbar -->
    @include('layouts.navbar')
    <div class="container top-buffer-30">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Appointment types</div>
                    </div>
                </div>
                <div class="row col-md-12 top-buffer">
                    <div class="col-md-6 custom-hello-week vertical-menu" id="app_types" onload="loadAppointmentTypes(false)">
                    </div>
                    <div class="col-md-6 custom-hello-week">
                        <form action="javascript:void(0);">
                            <div class="row">
                                <div class="col">
                                    <label>Name of the appointment: </label><input type="text" name="Description" id="Description" class="form-control" placeholder="Description">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                   <label>Duration in minutes: </label><input type="number" name="length" id="capacity" value="1" min="1" pattern=" 0+\.[0-9]*[1-9][0-9]*$" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label>Amount of people:</label><input type="number" name="length" id="length" value="1" min="1" pattern=" 0+\.[0-9]*[1-9][0-9]*$" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col top-buffer-small">
                                    <button onclick="submitAppointmentType()">Add appointment type</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div> 
            </div> 
    </div>
    <div class="container top-buffer-30">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Opening times</div>
                    <!-- TODO: Create list for each day, then show list of opening times for this specific day -->
                </div>
            </div>
            <div class="row col-md-12 top-buffer">
                <div class="col-md-6 custom-hello-week vertical-menu" id="open_times" onload="loadOpenTimes()">
                    @inject('configcontroller', 'App\Http\Controllers\ConfigurationController')
                    <div class="card">
                        <div class="card-header">
                          Monday
                        </div>
                        <div class="card-body">
                            <ul class="list-group-flush">
                                <?php echo $configcontroller::getOpenTimesForDay('Monday');?>
                            </ul>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                          Tuesday
                        </div>
                        <div class="card-body">
                            <ul class="list-group-flush">
                                <?php echo $configcontroller::getOpenTimesForDay('Tuesday');?>
                            </ul>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                          Wednesday
                        </div>
                        <div class="card-body">
                            <ul class="list-group-flush">
                                <?php echo $configcontroller::getOpenTimesForDay('Wednesday');?>
                            </ul>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                          Thursday
                        </div>
                        <div class="card-body">
                            <ul class="list-group-flush">
                                <?php echo $configcontroller::getOpenTimesForDay('Thursday');?>
                            </ul>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                          Friday
                        </div>
                        <div class="card-body">
                            <ul class="list-group-flush">
                                <?php echo $configcontroller::getOpenTimesForDay('Friday');?>
                            </ul>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                          Saturday
                        </div>
                        <div class="card-body">
                            <ul class="list-group-flush">
                                <?php echo $configcontroller::getOpenTimesForDay('Saturday');?>
                            </ul>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                          Sunday
                        </div>
                        <div class="card-body">
                            <ul class="list-group-flush">
                                <?php echo $configcontroller::getOpenTimesForDay('Sunday');?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 custom-hello-week">
                    <form action="javascript:void(0);">
                        <div class="row">
                            <div class="col">    
                                <label for="weekdays">Select day(s) of the week:</label>
                                <select class="multi-select-weekdays form-control" id="open_times_days" name="weekdays" multiple="multiple"> 
                                    <option value="Monday">Monday</option>
                                    <option value="Tuesday">Tuesday</option>
                                    <option value="Wednesday">Wednesday</option>
                                    <option value="Thursday">Thursday</option>
                                    <option value="Friday">Friday</option>
                                    <option value="Saturday">Saturday</option>
                                    <option value="Sunday">Sunday</option>
                                </select>                     
                            </div> 
                        </div>
                        <div class="row">
                            <div class="col">
                                <!-- datepicker npm install @chenfengyuan/datepicker - https://github.com/fengyuanchen/datepicker - Included in the app.blade.php file -->
                                <!-- select start date -->
                                <label class="top-buffer-small" for="start_date_picker">
                                        Select the start date:
                                </label>
                                <input id="start_date_picker" data-toggle="datepicker" class="form-control" placeholder="Select start date">
                                <div data-toggle="datepicker"></div>
                            </div>  
                            <div class="col">
                                <label class="top-buffer-small" for="end_date_picker">
                                    Select the end date:
                                </label>
                                <input id="end_date_picker" data-toggle="datepicker" class="form-control" placeholder="Select end date">
                                <div data-toggle="datepicker"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                            </div>           
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="noEndDate" onclick="hideEndDate();">
                                    <label class="form-check-label" for="noEndDate">
                                        No end date
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <!-- select start time -->
                                <label class="top-buffer-small" for="start_time_picker">
                                        Select the start time:
                                </label>
                                <div class="input-group clockpicker">
                                    <input id="start_time_picker" type="text" class="form-control" value="" placeholder="Select start time">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                </div>                               
                            </div>
                            <div class="col">
                                <!-- select end time -->
                                <label class="top-buffer-small" for="end_time_picker">
                                        Select the end time:
                                </label>
                                <div class="input-group clockpicker">
                                    <input id="end_time_picker" type="text" class="form-control" value="" placeholder="Select end time">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                </div>   
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="selectable-apptypes">Allowed appointments:</label>
                                <select class="multi-select-appointment-types form-control" id="selectable-apptypes" name="selectable-apptypes" multiple="multiple"> 
                                </select>  
                            </div>
                        </div>
                        <div class="row">
                            <div class="col top-buffer-small">
                                <button onclick="submitOpenTime()">Add opening times</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div> 
        </div> 
    </div>
    <script>    
    /*
    * Global variables
    */
    var modalID = 0;

    /** 
     * Functionalities
     */ 
       $(document).ready(function(){
            setTimeout(function(){
                loadAppointmentTypes(true);
            }, 100);
            $('.multi-select-weekdays').select2({ //https://select2.org/
                placeholder: "Select day(s) of the week",
                allowClear: true,
                closeOnSelect: false
            });
            $('.multi-select-appointment-types').select2({
                placeholder: "Select appointment types",
                allowClear: true,
                closeOnSelect: false
            });
	    });	
        function loadAppointmentTypes(load){
            var request = $.get('/loadAppointmentTypes');
            if(load){
                waitingDialog.show('Loading appointment types..');
            }
            request.done(function(response) {
                while (document.getElementById("app_types").firstChild) {
					document.getElementById("app_types").removeChild(document.getElementById("app_types").firstChild);
				}
                document.getElementById('app_types').innerHTML = response;  
                if(load){
                    loadAppointmentTypesForSelect();
                    waitingDialog.hide();       
                }      
            });            
        }
        function submitAppointmentType() {
            var description = document.getElementById("Description").value;
            var length = document.getElementById("length").value;
            var capacity = document.getElementById("capacity").value;
            var request = $.get('/createAppointmentType/' + description + "/" + length + "/" + capacity);
            waitingDialog.show('Creating appointment type..');
            request.done(function(response) {
                alert(response);
                if(response.includes("successfully")){
                    loadAppointmentTypes(false);
                    waitingDialog.hide();
                }
                else{
                    waitingDialog.hide();
                    alert("The appointment creation went wrong. Please try again later or contact the system administrator.")
                }
            });
        }
        function editAppointment(id){
            alert("edit clicked with ID= " + id);

        }
        function deleteAppointment(id,description){
            if (confirm("Are you sure you want to remove appointment type \"" + description + "\"?")) {
                var request = $.get('/deleteAppointmentType/' + id);
                waitingDialog.show('Deleting appointment types.');
                request.done(function(response) {
                    if(response.includes("successfully")){
                        loadAppointmentTypes(false);
                        waitingDialog.hide();
                        alert("The appointment type is deleted");
                    }
                    else{
                        waitingDialog.hide();
                        alert("The deletion went wrong. Please try again later or contact the system administrator.")
                    }                    
                });
            } else {
                //Do nothing, user clicked cancel on deletion of the app type
            }
        }
        /*
        * This function adds opening hours. It gets the info from the input fields and calls the correct PHP functions
        */
        function submitOpenTime(){
            var open_times_days = $('.multi-select-weekdays').select2('data');
            var open_times_day_php ="";
            //getting all ID from the list and put them in correct format for PHP
            for(var i=0;i<open_times_days.length;i++){
                open_times_day_php = open_times_day_php + open_times_days[i].id + ".";
            }
            var start_date = document.getElementById("start_date_picker").value;
            var end_date = document.getElementById("end_date_picker").value;
            if(end_date == ""){ //no end date so appointment lasts 10 years
                var start = start_date.split("-"); //split the start date to get the year
                var end_year = parseInt(start[2],10) +10; //convert year to decimal number
                end_date = start[0] + "-" + start[1] + "-" + end_year.toString(); 
            }
            var start_time = document.getElementById("start_time_picker").value;
            var end_time = document.getElementById("end_time_picker").value;
            var appointment_types = $('.multi-select-appointment-types').select2('data');
            var appointment_types_php ="";
            //getting all ID from the appointment type selected list and put them in correct format for PHP
            for(var i=0;i<appointment_types.length;i++){
                appointment_types_php = appointment_types_php + appointment_types[i].id + ".";
            }            
            var request = $.get('/createOpenTime/' + open_times_day_php + "/" + start_date + "/" + end_date  + "/" + start_time + "/" + end_time  + "/" + appointment_types_php);
            waitingDialog.show('Creating opening times..');
            request.done(function(response) {
                if(response.includes("successfully")){
                    alert("Open times added.")
                    waitingDialog.hide();
                }
                else{
                    waitingDialog.hide();
                    alert("The creation of opening times went wrong. Please try again later or contact the system administrator.")
                }
            });      
        }
        /*
        * This function is used to delete opening hours.
        */
        function removeAppointment(id,weekday){
            alert(id); //TODO: call function to remove the correct id and weekday. If there are no more weekdays for open_times, remove the open_times
        }

        //link a function to show of the modal to add varaibles 
        $('#modifyAppTypeModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            modalID = button.data('id'); // Extract info from data-* attributes
            var description = button.data('description'); // Extract info from data-* attributes
            var length = button.data('length'); // Extract info from data-* attributes
            var capacity = button.data('capacity'); // Extract info from data-* attributes
            var modal = $(this);
            modal.find('.modal-title').text('Edit appointment type ');
            modal.find('.modal-body #modal-description').val(description);
            modal.find('.modal-body #modal-capacity').val(capacity);
            modal.find('.modal-body #modal-length').val(length);
            $('#modifyAppTypeModal').modal('hide');
        });
        //link a function to the click of the primary button of the modifyAppTypeModal
        $('#modifyAppTypeModal').on('click', '.btn-primary', function(){
            if (confirm("Are you sure you want to overwrite the changes made to the appointment type?")) {
                var request = $.get('/modifyAppointmentType/' + modalID  + "/" +  document.getElementById('modal-description').value  + "/" +  document.getElementById('modal-capacity').value  + "/" +  document.getElementById('modal-length').value);
                waitingDialog.show('Changing the appointment type..');
                request.done(function(response) {
                    if(response.includes("successfully")){
                        loadAppointmentTypes(false);
                        waitingDialog.hide();
                        $('#modifyAppTypeModal').modal('hide');
                        alert("The appointment type is modified.");
                    }
                    else{
                        waitingDialog.hide();
                        alert("The modification went wrong. Please try again later or contact the system administrator.")
                    }
                    
                });             
            } else {
                //user does not want to save the changes
                $('#modifyAppTypeModal').modal('hide');
            }
        });
        //link a function to the click of the secondary button of the modifyAppTypeModal
        $('#modifyAppTypeModal').on('click', '.btn-secondary', function(){
            if (confirm("Are you sure you want to throw away the changes made to the appointment type?")) {
                $('#modifyAppTypeModal').modal('hide');
            } else {
                //Do nothing, user wants to save the changes
            }
        });
        
        /** 
         * Code to add/modify open times
         */ 
         $('.clockpicker').clockpicker({
            placement: 'top',
            align: 'left',
            autoclose: 'true',
            'default': 'now'
        });
        $('[data-toggle="datepicker"]').datepicker({
            format: 'dd-mm-yyyy',
            weekStart: 1,
            autoHide: true,
            zIndex: 1051,
        });
        function hideEndDate(){
            if (document.getElementById('noEndDate').checked) 
            {
                document.getElementById('end_date_picker').disabled = true;
            } else {
                document.getElementById('end_date_picker').disabled = false;
            }
        }
        function loadAppointmentTypesForSelect(){
            var request = $.get('/loadAppointmentTypesForSelect');
            request.done(function(response) {
                $('.multi-select-appointment-types').val(null).trigger('change');
                var appTypes = JSON.parse(response);
                for(var i=0; i < appTypes.length; i++){
                    var appType = appTypes[i];                    
                    var newOption = new Option(appType["description"], appType["id"], false, false);
                    $('.multi-select-appointment-types').append(newOption).trigger('change');
                }
            });  
        }
        /** 
         * Loader code
         * https://bootsnipp.com/snippets/featured/quotwaiting-forquot-modal-dialog
         */
        var waitingDialog = waitingDialog || (function ($) {
            'use strict';

            // Creating modal dialog's DOM
            var $dialog = $(
                '<div class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true" style="padding-top:15%; overflow-y:visible;">' +
                '<div class="modal-dialog modal-m">' +
                '<div class="modal-content">' +
                    '<div class="modal-header"><h3 style="margin:0;"></h3></div>' +
                    '<div class="modal-body">' +
                        '<div class="progress progress-striped active" style="margin-bottom:0;"><div class="progress-bar" style="width: 100%"></div></div>' +
                    '</div>' +
                '</div></div></div>');

            return {
                /**
                 * Opens our dialog
                 * @param message Custom message
                 * @param options Custom options:
                 * 				  options.dialogSize - bootstrap postfix for dialog size, e.g. "sm", "m";
                 * 				  options.progressType - bootstrap postfix for progress bar type, e.g. "success", "warning".
                 */
                show: function (message, options) {
                    // Assigning defaults
                    if (typeof options === 'undefined') {
                        options = {};
                    }
                    if (typeof message === 'undefined') {
                        message = 'Loading';
                    }
                    var settings = $.extend({
                        dialogSize: 'm',
                        progressType: '',
                        onHide: null // This callback runs after the dialog was hidden
                    }, options);

                    // Configuring dialog
                    $dialog.find('.modal-dialog').attr('class', 'modal-dialog').addClass('modal-' + settings.dialogSize);
                    $dialog.find('.progress-bar').attr('class', 'progress-bar');
                    if (settings.progressType) {
                        $dialog.find('.progress-bar').addClass('progress-bar-' + settings.progressType);
                    }
                    $dialog.find('h3').text(message);
                    // Adding callbacks
                    if (typeof settings.onHide === 'function') {
                        $dialog.off('hidden.bs.modal').on('hidden.bs.modal', function (e) {
                            settings.onHide.call($dialog);
                        });
                    }
                    // Opening dialog
                    $dialog.modal();
                },
                /**
                 * Closes dialog
                 */
                hide: function () {
                    $dialog.modal('hide');
                }
            };

        })(jQuery);


    </script>
</body>
