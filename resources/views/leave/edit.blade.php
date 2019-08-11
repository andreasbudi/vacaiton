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
                                        <input type="text" name="from" id="from-date" class="form-control" autocomplete="off" placeholder="Select start date" required autocomplete="from">
                                    </div>
                            </div>
                            <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                        To:
                                    </label>
                                    <div class="col-lg-6">     
										<input type="text" name="to" id="to-date" class="form-control" autocomplete="off" placeholder="Select end date" required autocomplete="to">
                                    </div>
                            </div>
                            <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                        Duration:
                                    </label>
                                    <div class="col-lg-6">
										<input type="text" name="duration" id="total" class="form-control" readonly="readonly"> 
                                    </div>
                            </div>
                            <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                        Leave Type:
                                    </label>
                                    <div class="col-lg-6">
										<select name="leave_type" id="leave_type" class="form-control" required autocomplete="leave_type">
                                            <option value="Annual Leave">Annual Leave</option>
                                    </select> 
                                    </div>
                            </div>
                            <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                            Reason:
                                    </label>
                                    <div class="col-lg-6">   
										<textarea class="form-control" name="reason" rows="2" cols="80" required autocomplete="reason">{{$leave->reason}}</textarea>
                                    </div>
                            </div> 

                        </div>
                    </div>

                    <div class="m-portlet__foot m-portlet__foot--fit">
                        <div class="m-form__actions m-form__actions">
                            <div class="row">
                                <div class="col-lg-2">
                                </div>
                                <div class="col-lg-6">
                                    <button type="submit" class="btn btn-primary">
                                         Update
                                    </button>
                                    <a class="btn btn-danger" href="/leave">Cancel</a>
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
            format: 'dd-mm-yyyy',
            todayHighlight:'TRUE',
            autoclose: true,
            daysOfWeekDisabled: [0,6],
            //datesDisabled: ['07-08-2019'],
        }).on('changeDate', function(ev) {
            ConfigureToDate();
        });

        // // create to date
        $('#to-date').datepicker({
            orientation: "bottom left",
            startDate: $('#from-date').val(),
            format: 'dd-mm-yyyy',
            todayHighlight:'TRUE',
            autoclose: true,
            daysOfWeekDisabled: [0,6],
            //datesDisabled: ['07-08-2019'],
        }).on('changeDate', function(ev) {
            var fromDate = $('#from-date').data('datepicker').dates[0];
            (async function(){
                $('#total').val(await getBusinessDatesCount(fromDate, ev.date));
            })();
        });

        // Set the min date on page load
        ConfigureToDate();

        // Resets the min date of the return date
        function ConfigureToDate() {
            $('#to-date').val("").datepicker("update");
            $('#to-date').datepicker('setStartDate', $('#from-date').val());
            $('#total').val("").datepicker("update");
        }
        });

        // function holidayPromiseThisYear(){
        //     return new Promise((resolve, reject)=>{
        //         $.get("/holidays/"+new Date().getFullYear(), function(data) {
        //     // do your data manipulation and transformation here
        //             resolve(data);
        //         });
        //         //resolve(["i", "love", "angiestee"]);
        //     })
        // } 

        // function holidayPromiseNextYear(){
        //     return new Promise((resolve, reject)=>{
        //         $.get("/holidays/"+(new Date().getFullYear()+1), function(data) {
        //     // do your data manipulation and transformation here
        //             resolve(data);
        //         });
        //         //resolve(["i", "love", "angiestee"]);
        //     })
        // } 

        async function getBusinessDatesCount(startDate, endDate) {
            console.log("Test tststs");
            var count = 1;
            var curDate = new Date(startDate);
            //console.log("Yang ini" + curDate);
            // var holidayThisYear = await holidayPromiseThisYear();
            // var holidayNextYear = await holidayPromiseNextYear();
            var holiday = [
              "2019-1-1",
              "2019-2-5",
              "2019-3-7",
              "2019-4-3",
              "2019-4-17",
              "2019-4-19",
              "2019-5-1",
              "2019-5-19",
              "2019-5-30",
              "2019-6-1",
              "2019-6-3",
              "2019-6-4",
              "2019-6-5",
              "2019-6-6",
              "2019-6-7",
              "2019-8-11",
              "2019-8-17",
              "2019-9-1",
              "2019-11-9",
              "2019-12-24",
              "2019-12-25",
              "2019-12-31",
              "2020-1-1",
              "2020-1-25",
              "2020-3-22",
              "2020-3-25",
              "2020-4-10",
              "2020-4-12",
              "2020-5-1",
              "2020-5-7",
              "2020-5-21",
              "2020-5-24",
              "2020-5-25",
              "2020-6-1",
              "2020-7-31",
              "2020-8-17",
              "2020-8-20",
              "2020-10-29",
              "2020-12-24",
              "2020-12-25",
              "2020-12-31",
              "2021-01-1"
            ]
            while (curDate <= endDate) {
                var dayOfWeek = curDate.getDay();
                var isExistThisYear = false;
                holiday.forEach((item, index)=>{
                    //console.log("This date " +new Date(item));
                    if(curDate.valueOf() == new Date(item).valueOf()){
                        isExistThisYear = true;
                        return; 
                    }
                })  
                // var isExistNextYear = false;
                // holidayNextYear.forEach((item, index)=>{
                //     console.log("This date " +new Date(item));
                //     if(curDate.valueOf() == new Date(item).valueOf()){
                //         isExistNextYear = true;
                //         return; 
                //     }
                // })  

                //console.log("Ada gk yaa "+isExist);
                
                
                if (!((dayOfWeek == 6) || (dayOfWeek == 0) || isExistThisYear) )
                count++;
                curDate.setDate(curDate.getDate() + 1);
                }

                if(count > {{ (Auth::user()->leaves_available) }}){
                    alert('Your remaining leave not sufficient');
    
                    $('#to-date').val("");
                }
            return count;
        }
</script>
@endpush