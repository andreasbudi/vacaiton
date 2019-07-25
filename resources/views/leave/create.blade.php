@extends('layouts.app')
@section('content')

<!-- BEGIN: Subheader -->
<div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">

                <h3 class="m-subheader__title m-subheader__title--separator">
                        Apply Form
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
                        <a href="{{ route('leave.create')}}" class="m-nav__link">
                            <span class="m-nav__link-text">
                                Apply Leaves
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
        @if (Auth::user()->leaves_available <= '0')
        <h3>Sorry You Can't Apply The Leave Request<br>Because Your Leave Balance Already Empty </h3>

        @else    
        <div class="row">
                <div class="col-xl-6">

                    <!--begin:: Widgets/Tasks -->
                    <div class="m-portlet m-portlet--full-height ">

                        <div class="m-portlet__head" style="text-align:right;">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">
                                        <span style="color:#A0A0A0;">Leave remaining</span> {{ (Auth::user()->leaves_available) }} days
                                    </h3>
                                </div>
                            </div>
                        </div>

                        <div class="m-portlet__body">
                            <div class="tab-content">
                                <div class="m-widget2">

                                    <form action="{{route('leave.store')}}" method="post">

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

                                        @csrf
                                        <div class="col-md-12">
                                            <strong>From :</strong>
                                            <input type="text" name="from" id="from-date" class="form-control" autocomplete="off" placeholder="Select start date">
                                        </div>
                                        <br>
                                        <div class="col-md-12">
                                            <strong>To :</strong>
                                           <input type="text" name="to" id="to-date" class="form-control" autocomplete="off" placeholder="Select end date"> 
                                        </div>
                                        <br>
                                        <div class="col-md-12">
                                            <strong>Duration :</strong>
                                            <input type="text" name="duration" id="total" class="form-control" readonly="readonly">
                                        </div>
                                        <br>
                                        <div class="col-md-12">
                                            <strong>Reason :</strong>
                                            <textarea class="form-control @error('reason') is-invalid @enderror" name="reason" rows="2" cols="80" placeholder="Write your reason leave"></textarea>

                                            @error('reason')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <br>
                                        <div class="col-md-12">
                                        <button type="submit" value="send" class="btn btn-sm btn-primary" style="float: right;">Submit</button>
                                        </div>

                                    </form>

                                </div>
                            </div>
                        </div>

                    </div>
                    <!--end:: Widgets/Tasks -->

                </div>

                <div class="col-xl-6">

                    <!--begin:: Widgets/Support Tickets -->
                    <div class="m-portlet m-portlet--full-height ">

                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">
                                        Calendar of Events
                                    </h3>
                                </div>
                            </div>
                        </div>

                        <div class="m-portlet__body">
                            <div class="m-widget3">
                                <div id="m_calendar"></div>
                            </div>
                        </div>

                    </div>
                    <!--end:: Widgets/Support Tickets -->

                </div>
        </div>
        @endif

@endsection

@push('scripts')
    {{-- For For the Event and Leave Record --}}
    <script>                     
    var CalendarExternalEvents = function() {
        var t = function() {
                $("#m_calendar_external_events .fc-event").each(function() {
                    $(this).data("event", {
                        title: $.trim($(this).text()),
                        stick: !0,
                        className: $(this).data("color"),
                        description: "Lorem ipsum dolor eius mod tempor labore"
                    }), $(this).draggable({
                        zIndex: 999,
                        revert: !0,
                        revertDuration: 0
                    })
                })
            },
            e = function() {
                var t = moment().startOf("day"),
                    e = t.format("YYYY-MM"),
                    i = t.clone().subtract(1, "day").format("YYYY-MM-DD"),
                    r = t.format("YYYY-MM-DD"),
                    n = t.clone().add(1, "day").format("YYYY-MM-DD");
                $("#m_calendar").fullCalendar({
                    header: {
                        left: "prev,next today",
                        center: "title",
                        right: "month,agendaWeek,agendaDay,listWeek"
                    },
                    // defaultView: "listWeek",
                    eventLimit: !0,
                    navLinks: !0,
                    events: [
                        {
                    title: "New Year's Day",
                    start:  "2019-01-01",
                    description: "New Year's Day",
                    className: "m-fc-event--danger m-fc-event--solid-warning"
                },{
                    title: "Chinese New Year",
                    start:  "2019-02-05",
                    description: "Chinese New Year",
                    className: "m-fc-event--danger m-fc-event--solid-warning"
                },{
                    title: "Bali Hindu New Year",
                    start:  "2019-03-07",
                    description: "Bali Hindu New Year",
                    className: "m-fc-event--danger m-fc-event--solid-warning"
                },{
                    title: "Isra Mi'raj",
                    start:  "2019-04-03",
                    description: "Isra Mi'raj",
                    className: "m-fc-event--danger m-fc-event--solid-warning"
                },{
                    title: "Good Friday",
                    start:  "2019-04-19",
                    description: "Good Friday",
                    className: "m-fc-event--danger m-fc-event--solid-warning"
                },{
                    title: "Labour Day",
                    start:  "2019-05-01",
                    description: "Labour Day",
                    className: "m-fc-event--danger m-fc-event--solid-warning"
                },{
                    title: "Waisak Day",
                    start:  "2019-05-19",
                    description: "Waisak Day",
                    className: "m-fc-event--danger m-fc-event--solid-warning"
                },{
                    title: "Ascension Day of Jesus Christ",
                    start:  "2019-05-30",
                    description: "Ascension Day of Jesus Christ",
                    className: "m-fc-event--danger m-fc-event--solid-warning"
                },{
                    title: "Pancasila Day",
                    start:  "2019-06-01",
                    description: "Pancasila Day",
                    className: "m-fc-event--danger m-fc-event--solid-warning"
                },{
                    title: "Lebaran Holiday",
                    start:  "2019-06-03",
                    end: "2019-06-04",
                    description: "Lebaran Holiday",
                    className: "m-fc-event--danger m-fc-event--solid-warning"
                },{
                    title: "Hari Raya Idul Fitri",
                    start:  "2019-06-05",
                    end: "2019-06-06",
                    description: "Hari Raya Idul Fitri",
                    className: "m-fc-event--danger m-fc-event--solid-warning"
                },{
                    title: "Lebaran Holiday",
                    start:  "2019-06-07",
                    description: "Lebaran Holiday",
                    className: "m-fc-event--danger m-fc-event--solid-warning"
                },{
                    title: "Idul Adha",
                    start:  "2019-08-11",
                    description: "Idul Adha",
                    className: "m-fc-event--danger m-fc-event--solid-warning"
                },{
                    title: "Independence Day",
                    start:  "2019-08-17",
                    description: "Independence Day",
                    className: "m-fc-event--danger m-fc-event--solid-warning"
                },{
                    title: "Islamic New Year",
                    start:  "2019-09-01",
                    description: "Islamic New Year",
                    className: "m-fc-event--danger m-fc-event--solid-warning"
                },{
                    title: "Prophet Muhammad's Birthday",
                    start:  "2019-11-09",
                    description: "Prophet Muhammad's Birthday",
                    className: "m-fc-event--danger m-fc-event--solid-warning"
                },{
                    title: "Christmas Holiday",
                    start:  "2019-12-24",
                    description: "Christmas Holiday",
                    className: "m-fc-event--danger m-fc-event--solid-warning"
                },{
                    title: "Christmas Day",
                    start:  "2019-12-25",
                    description: "Christmas Day",
                    className: "m-fc-event--danger m-fc-event--solid-warning"
                }
            
                // from DB    

                @foreach($leaves as $leave),{
                    title: "{{$leave->users->name}}",
                    start:  "{{$leave->from}}",
                    end: "{{$leave->to}}",
                    description: "{{$leave->reason}}",
                    className: "m-fc-event--danger m-fc-event--solid-warning"
                    }
                @endforeach
            ],
                    editable: !0,
                    droppable: !0,
                    drop: function(t, e, i, r) {
                        var n = $.fullCalendar.moment(t.format());
                        n.stripTime(), n.time("08:00:00");
                        var a = $.fullCalendar.moment(t.format());
                        a.stripTime(), a.time("12:00:00"), $(this).data("event").start = n, $(this).data("event").end = a, $("#m_calendar_external_events_remove").is(":checked") && $(this).remove()
                    },
                    eventRender: function(t, e) {
                        e.hasClass("fc-day-grid-event") ? (e.data("content", t.description), e.data("placement", "top"), mApp.initPopover(e)) : e.hasClass("fc-time-grid-event") ? e.find(".fc-title").append('<div class="fc-description">' + t.description + "</div>") : 0 !== e.find(".fc-list-item-title").lenght && e.find(".fc-list-item-title").append('<div class="fc-description">' + t.description + "</div>")
                    }
                })
            };
        return {
            init: function() {
                t(), e()
            }
        }
    }();
    jQuery(document).ready(function() {
        CalendarExternalEvents.init()
    });
    </script>

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
            daysOfWeekDisabled: [0,6],
        }).on('changeDate', function(ev) {
            ConfigureToDate();
        });

        // // create to date
        var endDate = {{ (Auth::user()->leaves_available) }}
        $('#to-date').datepicker({
            orientation: "bottom left",
            startDate: $('#from-date').val(),
            format: 'yyyy-mm-dd',
            todayHighlight:'TRUE',
            autoclose: true,
            daysOfWeekDisabled: [0,6],
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
        return count;
        }
    </script>

@endpush