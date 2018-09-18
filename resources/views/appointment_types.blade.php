@extends('home')

@section('appointment_types')
    <div class="container top-buffer-30">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Appointment types</div>
                    </div>
                </div>
                <div class="row col-md-12 top-buffer">
                    <div class="col-md-6 custom-hello-week vertical-menu" id="app_types" onload="loadAppointmentTypes()">
                    </div>
                    <div class="col-md-6 custom-hello-week">
                        <form>
                            <div class="row">
                                <div class="col">
                                    <label>Name of the appointment: </label><input type="text" name="Description" id="Description" class="form-control" placeholder="Description">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                   <label>Duration in minutes: </label><input type="number" name="length" id="capacity" value="1" min="1" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label>Name of the appointment:</label><input type="number" name="length" id="length" value="1" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <button onclick="submitAppointmentType()">Add appointment type</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div> 
            </div> 
    </div>
    <script>
        $(document).ready(function(){
            setTimeout(function(){
                loadAppointmentTypes();
            }, 100);
		
	    });	
        function loadAppointmentTypes(){
            var request = $.get('/loadAppointmentTypes');
            request.done(function(response) {
				while (document.getElementById("app_types").firstChild) {
					document.getElementById("app_types").removeChild(document.getElementById("app_types").firstChild);
				}
                document.getElementById('app_types').innerHTML = response;                
            });
        }
        function submitAppointmentType() {
            var description = document.getElementById("Description").value;
            var length = document.getElementById("length").value;
            var capacity = document.getElementById("capacity").value;
            var request = $.get('/createAppointmentType/' + description + "/" + length + "/" + capacity);
            request.done(function(response) {
                alert(response);
                if(response.includes("successfully")){
                    loadAppointmentTypes();
                }
            });
        }
    </script>
@endsection