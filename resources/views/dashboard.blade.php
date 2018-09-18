<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Dashboard</title>
    @include('layouts.header')
</head>
<body>
    <!-- Included the navbar -->
    @include('layouts.navbar')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card top-buffer">
                <div class="card-header">Dashboard</div>
            </div>
        </div>
        <div class="row top-buffer">
            <div class="col-md-6 hello-week">
                <div class="hello-week__header">
                    <button class="hello-week__prev">Prev</button>
                    <div class="hello-week__label"></div>
                    <button class="hello-week__next">Next</button>
                </div>
                <div class="hello-week__week"></div>
                <div class="hello-week__month"></div>
            </div>
            <div class="col-md-6 custom-hello-week">
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
  
</script>
</body>
