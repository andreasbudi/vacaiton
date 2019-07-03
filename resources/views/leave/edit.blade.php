@extends('layouts.app')
@section('content')
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> there where some problems with your input.<br>
                <ul>
                    @foreach ($errors as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif	
		<div class="col-xl-12" style="width:800px;">
			<!--begin:: Widgets/Tasks -->
			<div class="m-portlet m-portlet--full-height ">
				<div class="m-portlet__head">
					<div class="m-portlet__head-caption">
						<div class="m-portlet__head-title">
							<h3 class="m-portlet__head-text">
								Edit Leave
							</h3>
						</div>
					</div>
				</div>
	
				<div class="m-portlet__body">
					<div class="tab-content">
						<div class="m-widget2">
							<form action="{{route('leave.update',$leave->id)}}" method="post">
								@csrf
								@method('PUT')
								<div class="col-md-12">
									<strong>From :</strong>
									<input type="date" name="from" class="form-control" value="{{$leave->from}}">
								</div>
								<br>
								<div class="col-md-12">
									<strong>Duration :</strong>
									{{-- <input type="text" name="duration" id="duration" class="form-control"> --}}
									<select name="duration" id="duration" class="form-control" value="{{$leave->duration}}" onchange="run(this.value)">
									<script>
									function run(val) {
										var formDuration = document.getElementById("duration");
										var getDuration = formDuration.options[formDuration.selectedIndex].value;

										document.getElementById("from").addEventListener("change", function() {
										var input = new Date(this.value);
										var newdate = new Date(input);
										var temp = newdate.getDate();
										var calculate = temp + parseInt(getDuration);
										newdate.setDate(calculate);
										var dd = newdate.getDate();
										var mm = newdate.getMonth() + 1;
										var yyyy =  newdate.getFullYear();
										if (dd < 10) {
										dd = '0' + dd;
										} 
										if (mm < 10) {
										mm = '0' + mm;
										} 
										var someFormattedDate = yyyy + '/' + mm + '/' + dd;
										document.getElementById('to').value = someFormattedDate;
										});
									}
									(function() { // don't leak
										var elm = document.getElementById('duration'), // get the select
											df = document.createDocumentFragment(); // create a document fragment to hold the options while we create them
										for (var i = 1; i <= 12; i++) { 
											var option = document.createElement('option'); // create the option element
											option.value = i; // set the value property
											option.appendChild(document.createTextNode(i + " days")); // set the textContent in a safe way.
											df.appendChild(option); // append the option to the document fragment
										}
										elm.appendChild(df); // append the document fragment to the DOM. this is the better way rather than setting innerHTML a bunch of times (or even once with a long string)
								 
									}()); 
									</script>
									</select>
									
								</div>
								<br>
								<div class="col-md-12">
									<strong>To :</strong>
									<input type="date" name="to" class="form-control" value="{{$leave->to}}">
								</div>
								<br>
								<div class="col-md-12">
									<strong>Reason :</strong>
									   <textarea class="form-control" name="reason" rows="2" cols="80">{{$leave->reason}}</textarea>
								</div>
								<br>
								<div class="col-md-12">
									<button type="submit" class="btn btn-sm btn-primary" style="float: right;">Submit</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<!--end:: Widgets/Tasks -->
		</div>
@endsection
