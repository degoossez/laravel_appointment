<div class="container top-buffer-30">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Calendar view</div>
                </div>
            </div>
            <div class="row top-buffer">
                <div class="col-md-4 hello-week-customer hello-week">
                    <div class="hello-week__header">
                        <button class="hello-week__prev">Prev</button>
                        <div class="hello-week__label"></div>
                        <button class="hello-week__next">Next</button>
                    </div>
                    <div class="hello-week__week"></div>
                    <div class="hello-week__month"></div>
                </div>
                <div class="col-md-4 custom-hello-week">
                    <ul class="nav nav-tabs nav-fill" id="mySelectedAppointmentTab" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="Overview-tab" data-toggle="tab" href="#Overview" role="tab" aria-controls="Overview" aria-selected="true">Select appointment</a>
                      </li>
                    </ul>
                    <div class="tab-content" id="mySelectedAppointmentTab">
                      <div class="tab-pane fade show active" id="Overview" role="tabpanel" aria-labelledby="Overview-tab">
                        <div class="vertical-menu" id="vertical_select_appointment">

                        </div>
                     </div>
                    </div>
                </div>
                <div class="col-md-4 custom-hello-week">
                     <a>show details of the selected appointment </a>
                </div>
            </div>
        </div> 
    </div>
</div>
<script>  
    const customerCalendar = new HelloWeek({
        selector: '.hello-week-customer',
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
        onLoad: getFreeAppointmentsForToDay,
        onChange: () => { /** callback function */ },
        onSelect: getFreeAppointmentsForSelectedDay,
        onClear: () => { /** callback function */ }
    });
    function getFreeAppointmentsForSelectedDay(){
        /*if(this.lastSelectedDay != ""){
            var request = $.get('/appointmentsonday/' + this.lastSelectedDay);
            request.done(function(response) {
                console.log(response);
                while (document.getElementById("vertical_overview").firstChild) {
                    document.getElementById("vertical_overview").removeChild(document.getElementById("vertical_overview").firstChild);
                }
                document.getElementById('vertical_overview').innerHTML = response;
            });
        }*/
    }  
    function getFreeAppointmentsForToDay(){
        /*var today = this.getToday('YYYY-MM-DD');
        var request = $.get('/appointmentsonday/' + today);
        request.done(function(response) {
            console.log(response);
            while (document.getElementById("vertical_overview").firstChild) {
                document.getElementById("vertical_overview").removeChild(document.getElementById("vertical_overview").firstChild);
            }
            document.getElementById('vertical_overview').innerHTML = response;
        });*/
    }  
</script>
