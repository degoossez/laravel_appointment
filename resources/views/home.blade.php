<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Home</title>
    @include('layouts.header')
    <?php include "/home/vagrant/code/appointments/resources/views/Modals/add_open_times.blade.php"; ?>
</head>
<body>        
    <!-- Included the navbar -->
    @include('layouts.navbar')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>
            </div>
        </div>
        <div class="row top-buffer">
            <div class="col-md-4 hello-week">
                <div class="hello-week__header">
                    <button class="hello-week__prev">Prev</button>
                    <div class="hello-week__label"></div>
                    <button class="hello-week__next">Next</button>
                </div>
                <div class="hello-week__week"></div>
                <div class="hello-week__month"></div>
            </div>
            <div class="col-md-4 custom-hello-week">
                <!-- show an overview google calendar style of all appointments and when it's "open" -->
                <ul class="nav nav-tabs nav-fill" id="myOverviewTab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="Overview-tab" data-toggle="tab" href="#Overview" role="tab" aria-controls="Overview" aria-selected="true">Overview</a>
                  </li>
                </ul>
                <div class="tab-content" id="myOverviewTab">
                    <div class="tab-pane fade show active" id="Overview" role="tabpanel" aria-labelledby="Overview-tab">
                        <div class="vertical-menu" id="vertical_overview">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 custom-hello-week">
                <!-- show an overview google calendar style of all appointments and when it's "open" -->
                <ul class="nav nav-tabs nav-fill" id="tabOpenTimes" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="navOpenTimes" data-toggle="tab" href="#OpenTimes" role="tab" aria-controls="OpenTimes" aria-selected="true">Opening hours</a>
                    </li>
                </ul>
                <div class="tab-content" id="tabOpenTimes">
                            <a>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="recCheck" onclick="displayDays();">
                                            <label class="form-check-label" for="recCheck">
                                                    Recurrent
                                            </label>
                                        </div>
                                        <ul id="dayList" style="display:none;">
                                            <li>
                                                <input class="form-check-input" type="checkbox" value="" id="mondayCheck">
                                                <label class="form-check-label" for="mondayCheck">Monday</label>
                                            </li>
                                            <li>
                                                <input type="checkbox" class="form-check-input" id="tuesdayCheck">
                                                <label class="form-check-label" for="tuesdayCheck">Tuesday</label>
                                            </li>
                                            <li>
                                                <input type="checkbox" class="form-check-input" id="wednesdayCheck">
                                                <label class="form-check-label" for="wednesdayCheck">Wednesday</label>
                                            </li>
                                            <li>
                                                <input type="checkbox" class="form-check-input" id="thursdayCheck">
                                                <label class="form-check-label" for="thursdayCheck">Thursday</label>
                                            </li>
                                            <li>
                                                <input type="checkbox" class="form-check-input" id="fridayCheck">
                                                <label class="form-check-label" for="fridayCheck">Friday</label>
                                            </li>
                                            <li>
                                                <input type="checkbox" class="form-check-input" id="saturdayCheck">
                                                <label class="form-check-label" for="saturdayCheck">Saturday</label>
                                            </li>
                                            <li>
                                                <input type="checkbox" class="form-check-input" id="sundayCheck">
                                                <label class="form-check-label" for="sundayCheck">Sunday</label>
                                            </li>
                                        </ul>
                                        <label for="open-times-description" class="col-form-label">Description (optional):</label>
                                        <input type="text" class="form-control" id="open-times-description">
                                    <!-- datepicker npm install @chenfengyuan/datepicker - https://github.com/fengyuanchen/datepicker - Included in the app.blade.php file -->
                                <!-- select start date -->
                                <label class="top-buffer-small" for="start_date_picker">
                                        Select the start date:
                                </label>
                                <input id="start_date_picker" data-toggle="datepicker" class="form-control" placeholder="select start date">
                                <div data-toggle="datepicker"></div>
                                <!-- select start time -->
                                <label class="top-buffer-small" for="start_date_picker">
                                        Select the start time:
                                </label>
                                <div class="input-group clockpicker">
                                    <input id="start_time_picker" type="text" class="form-control" value="" placeholder="select start time">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                </div>     
                                <!-- select end date -->
                                <label class="top-buffer-small" for="start_date_picker">
                                        Select the end date:
                                </label>
                                <input id="end_date_picker" data-toggle="datepicker" class="form-control" placeholder="select end date">
                                <div data-toggle="datepicker"></div>
                                <!-- select end time -->
                                <label class="top-buffer-small" for="start_date_picker">
                                        Select the end time:
                                </label>
                                <div class="input-group clockpicker">
                                    <input id="end_time_picker" type="text" class="form-control" value="" placeholder="select end time">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                </div>   
                                <button onclick="submitOpeningTimes()">Add opening times</button>          
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                @yield('appointment_types')
                @include('user_calendar')
            </div>
        </div>
    </div>
</div>
<script>    
    const vert_appointments = document.getElementById('vertical_overview'); 
    const myCalendar = new HelloWeek({
        selector: '.hello-week',
        lang: 'en',
        langFolder: '{{ url('/') }}/langs/',
        format: 'YYYY-MM-DD',
        weekShort: true,
        monthShort: false,
        multiplePick: false,
        defaultDate: false,
        todayHighlight: true,
        disablePastDays: false,
        disabledDaysOfWeek: false,
        disableDates: false,
        weekStart: 1,
        daysHighlight: false,
        range: false,
        minDate: false,
        maxDate: false,
        nav: ['◀', '▶'],
        onLoad: getAppointmentsForToDay,
        onChange: () => { /** callback function */ },
        onSelect: getAppointmentsForSelectedDay,
        onClear: () => { /** callback function */ }
    });
    function getAppointmentsForSelectedDay(){
        if(this.lastSelectedDay != ""){
            var request = $.get('/appointmentsonday/' + this.lastSelectedDay);  
            request.done(function(response) {
                console.log(response);
				while (document.getElementById("vertical_overview").firstChild) {
					document.getElementById("vertical_overview").removeChild(document.getElementById("vertical_overview").firstChild);
				}
                document.getElementById('vertical_overview').innerHTML = response;
            });
        }
    }  
    function getAppointmentsForToDay(){
        var today = this.getToday('YYYY-MM-DD');
        var request = $.get('/appointmentsonday/' + today);
        request.done(function(response) {
            console.log(response);
			while (document.getElementById("vertical_overview").firstChild) {
				document.getElementById("vertical_overview").removeChild(document.getElementById("vertical_overview").firstChild);
			}
            document.getElementById('vertical_overview').innerHTML = response;
        });
    }  
    //link a function to the click of the primary button of the button
    $('#exampleModal').on('click', '.btn-primary', function(){
        alert("you clicked on the primary button!");
            /*var value = $('#myPopupInput').val();
            $('#myMainPageInput').val(value);
            $('#myModal').modal('hide');*/
            $('#exampleModal').modal('hide');
    });
    $('.clockpicker').clockpicker({
        placement: 'bottom',
        align: 'left',
        autoclose: 'true',
        'default': 'now'
    });
    $('[data-toggle="datepicker"]').datepicker({
        weekStart: 1,
        zIndex: 1051,
    })

    function displayDays() {
        if (document.getElementById('recCheck').checked) 
        {
        document.getElementById('dayList').style.display = "";
        } else {
        //Hide the days
        document.getElementById('dayList').style.display = "none";
        }
    }   
    function submitOpeningTimes(){
        //TODO
    } 
  
</script>
</body>
