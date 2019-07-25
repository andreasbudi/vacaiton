@extends('layouts.app')
@section('content')
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
                                        <input type="text" name="from" id="from-date" value="{{$leave->from}}" class="form-control" autocomplete="off">
                                    </div>
                            </div>
                            <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                        To:
                                    </label>
                                    <div class="col-lg-6">     
										<input type="text" name="to" id="to-date" value="{{$leave->to}}" class="form-control" autocomplete="off">
                                    </div>
                            </div>
                            <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                        Duration:
                                    </label>
                                    <div class="col-lg-6">
										<input type="text" name="duration" id="total" value="{{$leave->duration}}" class="form-control" autocomplete="off"> 
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
                                        <button type="submit" class="btn btn-primary">
                                            Update
                                        </button>
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
 {{-- For from calender datepicker --}}
    <script>
        $(function() {
        // create from date
        $('#from-date').datepicker({
            orientation: "bottom left",
            startDate : new Date(),
            format: 'yyyy-mm-dd',
            todayHighlight:'TRUE',
            autoclose: true,
            daysOfWeekDisabled: [0,6]
        }).on('changeDate', function(ev) {
            ConfigureToDate();
        });

        // create from date
        $('#to-date').datepicker({
            orientation: "bottom left",
            startDate: $('#from-date').val(),
            format: 'yyyy-mm-dd',
            todayHighlight:'TRUE',
            autoclose: true,
            daysOfWeekDisabled: [0,6]
        }).on('changeDate', function(ev) {
            var fromDate = $('#from-date').data('datepicker').dates[0];
            $('#total').val(getBusinessDatesCount(fromDate, ev.date));
        });

        // Set the min date on page load
        ConfigureToDate();

        // Resets the min date of the return date
        function ConfigureToDate() {
            $('#to-date').val("").datepicker("update");
            $('#to-date').datepicker('setStartDate', $('#from-date').val());
        }
        });

        function getBusinessDatesCount(startDate, endDate) {
        var count = 0;
        var curDate = new Date(startDate);
        while (curDate <= endDate) {
            var dayOfWeek = curDate.getDay();
            if (!((dayOfWeek == 6) || (dayOfWeek == 0)))
            count++;
            curDate.setDate(curDate.getDate() + 1);
            }
            
            if(count > {{ (Auth::user()->leaves_available) }}){
                alert('Your Leave Balance not sufficient');
                
                ConfigureToDate();
            }
        return count;
        }
    </script>
@endpush
