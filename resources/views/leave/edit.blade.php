@extends('layouts.app')
@section('content')

<!-- BEGIN: Subheader -->
<div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                        Edit Leave
                </h3>
                <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                    <li class="m-nav__item m-nav__item--home">
                        <a href="/home" class="m-nav__link m-nav__link--icon">
                            <i class="m-nav__link-icon la la-home"></i>
                        </a>
                    </li>
                    <li class="m-nav__separator">
                        -
                    </li>
                    <li class="m-nav__item">
                        <a class="m-nav__link">
                            <span class="m-nav__link-text">
                                Edit Leave
                            </span>
                        </a>
                    </li>
                    
                </ul>
            </div>
            <div>
                
            </div>
        </div>
    </div>
    <!-- END: Subheader -->
<div class="m-content">
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
                                Your Leave Form
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
                                        Duration:
                                    </label>
                                    <div class="col-lg-6">
										<select name="duration" id="duration" class="form-control" onchange="run(this.value)">
											<script>
											function run(val) {
											document.getElementById("from").addEventListener("change", function() {	
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
											for (var i = 0; i <= {{ (Auth::user()->leaves_available) }}; i++) { 
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
                                        From:
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" name="from" id="m_datepicker_1" value="{{$leave->from}}" class="form-control" autocomplete="off">
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
                    </div>
                    <div class="m-portlet__foot m-portlet__foot--fit">
                        <div class="m-form__actions m-form__actions">
                            <div class="row">
                                <div class="col-lg-2"></div>
                                    <div class="col-lg-6">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                        <a class="btn btn-danger" href="/leave">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!--end::Form-->
            
            </div>
            <!--end::Portlet-->
        </div>
    </div>          
</div>
@endsection

@push('scripts')
 {{-- For the calender datepicker --}}
    <script>
        var BootstrapDatepicker = function() {
        var t = function() {
            $("#m_datepicker_1, #m_datepicker_1_validate").datepicker({
                todayHighlight: !0,
                startDate : new Date(),
                daysOfWeekDisabled: [0,6],
                format: 'yyyy-mm-dd',
                orientation: "bottom left",
                templates: {
                    leftArrow: '<i class="la la-angle-left"></i>',
                    rightArrow: '<i class="la la-angle-right"></i>'
                }
            })
            };
        return {
            init: function() {
                t()
            }
            }
        }();
        jQuery(document).ready(function() {
            BootstrapDatepicker.init()
        });
    </script>
@endpush
