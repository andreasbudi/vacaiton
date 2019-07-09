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

	<div class="row">
        <div class="col-lg-12">
            <!--begin::Portlet-->
            <div class="m-portlet">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--hide">
                                <i class="la la-gear"></i>
                            </span>
                            <h3 class="m-portlet__head-text">
                                Edit Leave Form
                            </h3>
                        </div>
                    </div>
                </div>
                <!--begin::Form-->
                <form  class="m-form m-form--label-align-right" action="{{route('leave.update',$leave->id)}}" method="post">
                    @csrf
					@method('PUT')
                    <div class="m-portlet__body">
                        <div class="m-form__section m-form__section--first">
                            
                            <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                        From:
                                    </label>
                                    <div class="col-lg-6">
										<input type="date" name="from" id="from" value="{{$leave->from}}" class="form-control" onchange="run(this.value)">
                                    </div>
                            </div>
                            <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                        Duration:
                                    </label>
                                    <div class="col-lg-6">
										<select name="duration" id="duration" class="form-control">
											<script>
											function run(val) {
											document.getElementById("from").addEventListener("click", function() {	
											var formDuration = document.getElementById("duration");
											var getDuration = formDuration.options[formDuration.selectedIndex].value;
										
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
											// var someFormattedDate = mm + '/' + dd + '/' + yyyy;
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
                            </div>
                            <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                        To:
                                    </label>
                                    <div class="col-lg-6">     
										<input type="text" name="to" id="to" value="{{$leave->to}}" class="form-control">
                                    </div>
                            </div>
                            <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                            Reason:
                                    </label>
                                    <div class="col-lg-6">   
										<textarea class="form-control" name="reason" rows="2" cols="80">{{$leave->reason}}</textarea>
                                    </div>
                            </div>   
                        </div>

                    <div class="m-portlet__foot m-portlet__foot--fit">
                        <div class="m-form__actions m-form__actions">
                            <div class="row">
                                <div class="col-lg-2"></div>
                                <div class="col-lg-6">
                                    <button type="submit" class="btn btn-primary">
                                        Update
                                    </button>
                                    <button type="reset" class="btn btn-secondary">
                                        Cancel
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!--end::Form-->
            </div>
            <!--end::Portlet-->
            <!--begin::Portlet-->
            
            <!--end::Portlet-->
        </div>
    </div>          

@endsection
