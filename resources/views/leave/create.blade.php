@extends('layouts.app')
@section('content')

<!-- BEGIN: Subheader -->
<div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">

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
                                Apply Leave
                            </span>
                        </a>
                    </li>
                </ul>
                
            </div>
        </div>
</div>
<!-- END: Subheader -->

<div class="m-content">

        @if (Auth::user()->isActivated == '0' && Auth::user()->leaves_available > 0)
        {{--For user account is deactivated--}}
        <script>
            alert("Your account is deactivated. Please contact administrator");
        </script>

    <div class="row">
        <div class="col-xl-6">
            <!--begin:: Widgets/Tasks -->
            <div class="m-portlet m-portlet--full-height ">

                <div class="m-portlet__head" style="text-align:right;">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text m--font-brand">
                                <span style="color:#A0A0A0;">Apply Leave
                            </h3>
                        </div>
                    </div>
                </div>

                <div class="m-portlet__body">
                    <div class="tab-content">
                        <div class="m-widget2">

                            <form>
                                <div class="col-md-12">
                                    <strong>From :</strong>
                                    <input type="text" name="from" id="from-date" class="form-control" autocomplete="off" placeholder="Select start date" required disabled>
                                </div>
                                <br>
                                <div class="col-md-12">
                                    <strong>To :</strong>
                                   <input type="text" name="to" id="to-date" class="form-control" autocomplete="off" placeholder="Select end date" disabled> 
                                </div>
                                <br>
                                <div class="col-md-12">
                                    <strong>Duration :</strong>
                                    <input type="text" name="duration" id="total" class="form-control" disabled>
                                </div>
                                <br>
                                <div class="col-md-12">
                                    <strong>Leave type :</strong>
                                    <select name="leave_type" id="leave_type" class="form-control" required autocomplete="leave_type" disabled>
                                            <option value="Annual Leave">Annual Leave</option>
                                    </select>
                                </div>
                                <br>
                                <div class="col-md-12">
                                    <strong>Reason :</strong>
                                    <textarea class="form-control" name="reason" rows="2" cols="80" placeholder="Write your leave reason" disabled></textarea>
                                </div>
                                <br>
                                <div class="col-md-12">
                                <button type="button" class="btn btn-sm btn-primary" style="float: right;">Submit</button>
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
                                    <span class="m-portlet__head-icon">
                                            <i class="flaticon-calendar-2"></i>
                                    </span>
                                    <h3 class="m-portlet__head-text m--font-brand">
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

@push('scripts')
{{-- For show the Event and Leave Record --}}
<script>                     
    var CalendarExternalEvents = function() {
        var t = function() {
                $("#m_calendar_external_events .fc-event").each(function() {
                    $(this).data("event", {
                        title: $.trim($(this).text()),
                        stick: !0,
                        className: $(this).data("color"),
                        description: ""
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
                    height: 600,
                    events: [
                        {
                    title: "New Year's Day",
                    start:  "2019-01-01",
                    description: "New Year's Day",
                    className: "m-fc-event--danger m-fc-event--solid-light"
                },{
                    title: "Chinese New Year",
                    start:  "2019-02-05",
                    description: "Chinese New Year",
                    className: "m-fc-event--danger m-fc-event--solid-light"
                },{
                    title: "Bali Hindu New Year",
                    start:  "2019-03-07",
                    description: "Bali Hindu New Year",
                    className: "m-fc-event--danger m-fc-event--solid-light"
                },{
                    title: "Isra Mi'raj",
                    start:  "2019-04-03",
                    description: "Isra Mi'raj",
                    className: "m-fc-event--danger m-fc-event--solid-light"
                },{
                    title: "Good Friday",
                    start:  "2019-04-19",
                    description: "Good Friday",
                    className: "m-fc-event--danger m-fc-event--solid-light"
                },{
                    title: "Labour Day",
                    start:  "2019-05-01",
                    description: "Labour Day",
                    className: "m-fc-event--danger m-fc-event--solid-light"
                },{
                    title: "Waisak Day",
                    start:  "2019-05-19",
                    description: "Waisak Day",
                    className: "m-fc-event--danger m-fc-event--solid-light"
                },{
                    title: "Ascension Day of Jesus Christ",
                    start:  "2019-05-30",
                    description: "Ascension Day of Jesus Christ",
                    className: "m-fc-event--danger m-fc-event--solid-light"
                },{
                    title: "Pancasila Day",
                    start:  "2019-06-01",
                    description: "Pancasila Day",
                    className: "m-fc-event--danger m-fc-event--solid-light"
                },{
                    title: "Lebaran Holiday",
                    start:  "2019-06-03",
                    end: "2019-06-04",
                    description: "Lebaran Holiday",
                    className: "m-fc-event--danger m-fc-event--solid-light"
                },{
                    title: "Hari Raya Idul Fitri",
                    start:  "2019-06-05",
                    end: "2019-06-06",
                    description: "Hari Raya Idul Fitri",
                    className: "m-fc-event--danger m-fc-event--solid-light"
                },{
                    title: "Lebaran Holiday",
                    start:  "2019-06-07",
                    description: "Lebaran Holiday",
                    className: "m-fc-event--danger m-fc-event--solid-light"
                },{
                    title: "Idul Adha",
                    start:  "2019-08-11",
                    description: "Idul Adha",
                    className: "m-fc-event--danger m-fc-event--solid-light"
                },{
                    title: "Independence Day",
                    start:  "2019-08-17",
                    description: "Independence Day",
                    className: "m-fc-event--danger m-fc-event--solid-light"
                },{
                    title: "Islamic New Year",
                    start:  "2019-09-01",
                    description: "Islamic New Year",
                    className: "m-fc-event--danger m-fc-event--solid-light"
                },{
                    title: "Prophet Muhammad's Birthday",
                    start:  "2019-11-09",
                    description: "Prophet Muhammad's Birthday",
                    className: "m-fc-event--danger m-fc-event--solid-light"
                },{
                    title: "Christmas Holiday",
                    start:  "2019-12-24",
                    description: "Christmas Holiday",
                    className: "m-fc-event--danger m-fc-event--solid-light"
                },{
                    title: "Christmas Day",
                    start:  "2019-12-25",
                    description: "Christmas Day",
                    className: "m-fc-event--danger m-fc-event--solid-light"
                }

                // show leave employee from DB     

                @foreach($leaves as $leave)
                    ,{
                    title: "{{$leave->users->name}}",
                    start:  "{{$leave->from}}",
                    end: "{{$leave->to}}T23:59:00",
                    description: "{{$leave->reason}}",
                    className: "m-fc-event--light m-fc-event--solid-success"
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
@endpush

        @endif
        {{--endfor user account is deactivated--}}

        @if (Auth::user()->leaves_available <= '0')
        {{--For user leave available is zero--}}
        <script>
            alert("Your remaining leave are zero. Please contact administrator");
        </script>

    <div class="row">

        <div class="col-xl-6">
            <!--begin:: Widgets/Tasks -->
            <div class="m-portlet m-portlet--full-height ">

                <div class="m-portlet__head" style="text-align:right;">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text m--font-brand">
                                <span style="color:#A0A0A0;">Remaining leave </span> {{ (Auth::user()->leaves_available) }} days
                            </h3>
                        </div>
                    </div>
                </div>

                <div class="m-portlet__body">
                    <div class="tab-content">
                        <div class="m-widget2">

                            <form>
                                <div class="col-md-12">
                                    <strong>From :</strong>
                                    <input type="text" name="from" id="from-date" class="form-control" autocomplete="off" placeholder="Select start date" disabled>
                                </div>
                                <br>
                                <div class="col-md-12">
                                    <strong>To :</strong>
                                   <input type="text" name="to" id="to-date" class="form-control" autocomplete="off" placeholder="Select end date" disabled> 
                                </div>
                                <br>
                                <div class="col-md-12">
                                    <strong>Duration :</strong>
                                    <input type="text" name="duration" id="total" class="form-control" disabled>
                                </div>
                                <br>
                                <div class="col-md-12">
                                    <strong>Leave type :</strong>
                                    <select name="leave_type" id="leave_type" class="form-control" required autocomplete="leave_type" disabled>
                                            <option value="Annual Leave">Annual Leave</option>
                                    </select>
                                </div>
                                <br>
                                <div class="col-md-12">
                                    <strong>Reason :</strong>
                                    <textarea class="form-control" name="reason" rows="2" cols="80" placeholder="Write your leave reason" disabled></textarea>
                                </div>
                                <br>
                                <div class="col-md-12">
                                <button type="button" class="btn btn-sm btn-primary" style="float: right;">Submit</button>
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
                            <span class="m-portlet__head-icon">
                                    <i class="flaticon-calendar-2"></i>
                            </span> 
                            <h3 class="m-portlet__head-text m--font-brand">
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

@push('scripts')
{{-- For show the Event and Leave Record --}}
<script>                     
    var CalendarExternalEvents = function() {
        var t = function() {
                $("#m_calendar_external_events .fc-event").each(function() {
                    $(this).data("event", {
                        title: $.trim($(this).text()),
                        stick: !0,
                        className: $(this).data("color"),
                        description: ""
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
                    height: 600,
                    events: [
                        {
                    title: "New Year's Day",
                    start:  "2019-01-01",
                    description: "New Year's Day",
                    className: "m-fc-event--danger m-fc-event--solid-light"
                },{
                    title: "Chinese New Year",
                    start:  "2019-02-05",
                    description: "Chinese New Year",
                    className: "m-fc-event--danger m-fc-event--solid-light"
                },{
                    title: "Bali Hindu New Year",
                    start:  "2019-03-07",
                    description: "Bali Hindu New Year",
                    className: "m-fc-event--danger m-fc-event--solid-light"
                },{
                    title: "Isra Mi'raj",
                    start:  "2019-04-03",
                    description: "Isra Mi'raj",
                    className: "m-fc-event--danger m-fc-event--solid-light"
                },{
                    title: "Good Friday",
                    start:  "2019-04-19",
                    description: "Good Friday",
                    className: "m-fc-event--danger m-fc-event--solid-light"
                },{
                    title: "Labour Day",
                    start:  "2019-05-01",
                    description: "Labour Day",
                    className: "m-fc-event--danger m-fc-event--solid-light"
                },{
                    title: "Waisak Day",
                    start:  "2019-05-19",
                    description: "Waisak Day",
                    className: "m-fc-event--danger m-fc-event--solid-light"
                },{
                    title: "Ascension Day of Jesus Christ",
                    start:  "2019-05-30",
                    description: "Ascension Day of Jesus Christ",
                    className: "m-fc-event--danger m-fc-event--solid-light"
                },{
                    title: "Pancasila Day",
                    start:  "2019-06-01",
                    description: "Pancasila Day",
                    className: "m-fc-event--danger m-fc-event--solid-light"
                },{
                    title: "Lebaran Holiday",
                    start:  "2019-06-03",
                    end: "2019-06-04",
                    description: "Lebaran Holiday",
                    className: "m-fc-event--danger m-fc-event--solid-light"
                },{
                    title: "Hari Raya Idul Fitri",
                    start:  "2019-06-05",
                    end: "2019-06-06",
                    description: "Hari Raya Idul Fitri",
                    className: "m-fc-event--danger m-fc-event--solid-light"
                },{
                    title: "Lebaran Holiday",
                    start:  "2019-06-07",
                    description: "Lebaran Holiday",
                    className: "m-fc-event--danger m-fc-event--solid-light"
                },{
                    title: "Idul Adha",
                    start:  "2019-08-11",
                    description: "Idul Adha",
                    className: "m-fc-event--danger m-fc-event--solid-light"
                },{
                    title: "Independence Day",
                    start:  "2019-08-17",
                    description: "Independence Day",
                    className: "m-fc-event--danger m-fc-event--solid-light"
                },{
                    title: "Islamic New Year",
                    start:  "2019-09-01",
                    description: "Islamic New Year",
                    className: "m-fc-event--danger m-fc-event--solid-light"
                },{
                    title: "Prophet Muhammad's Birthday",
                    start:  "2019-11-09",
                    description: "Prophet Muhammad's Birthday",
                    className: "m-fc-event--danger m-fc-event--solid-light"
                },{
                    title: "Christmas Holiday",
                    start:  "2019-12-24",
                    description: "Christmas Holiday",
                    className: "m-fc-event--danger m-fc-event--solid-light"
                },{
                    title: "Christmas Day",
                    start:  "2019-12-25",
                    description: "Christmas Day",
                    className: "m-fc-event--danger m-fc-event--solid-light"
                }

                // show leave employee from DB     

                @foreach($leaves as $leave)
                    ,{
                    title: "{{$leave->users->name}}",
                    start:  "{{$leave->from}}",
                    end: "{{$leave->to}}T23:59:00",
                    description: "{{$leave->reason}}",
                    className: "m-fc-event--light m-fc-event--solid-success"
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
@endpush
{{--For user leave available is zero--}}

        @elseif (Auth::user()->isActivated == '1')
        {{--For user active and leave available > 0--}}
   
    <div class="row">
        <div class="col-xl-6">
            <!--begin:: Widgets/Tasks -->
            <div class="m-portlet m-portlet--full-height ">

                <div class="m-portlet__head" style="text-align:right;">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text m--font-brand">
                                <span style="color:#A0A0A0;">Remaining leave </span> {{ (Auth::user()->leaves_available) }} days
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
                                    <input type="text" name="from" id="from-date" class="form-control" autocomplete="off" placeholder="Select start date" required autocomplete="from">
                                </div>
                                <br>
                                <div class="col-md-12">
                                    <strong>To :</strong>
                                   <input type="text" name="to" id="to-date" class="form-control" autocomplete="off" placeholder="Select end date" required autocomplete="to"> 
                                </div>
                                <br>
                                <div class="col-md-12">
                                    <strong>Duration :</strong>
                                    <input type="text" name="duration" id="total" class="form-control" readonly="readonly">
                                </div>
                                <br>
                                <div class="col-md-12">
                                    <strong>Leave type :</strong>
                                    <select name="leave_type" id="leave_type" class="form-control" required autocomplete="leave_type">
                                            <option value="Annual Leave">Annual Leave</option>
                                    </select>
                                </div>
                                <br>
                                <div class="col-md-12">
                                    <strong>Reason :</strong>
                                    <textarea class="form-control" name="reason" rows="2" cols="80" placeholder="Write your leave reason" required autocomplete="reason"></textarea>
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
                            <span class="m-portlet__head-icon">
                                    <i class="flaticon-calendar-2"></i>
                            </span>
                             <h3 class="m-portlet__head-text m--font-brand">
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
        {{--Endfor user leave available is zero--}}

@endsection

@push('scripts')
{{-- For show the Event and Leave Record --}}
<script>                     
    var CalendarExternalEvents = function() {
        var t = function() {
                $("#m_calendar_external_events .fc-event").each(function() {
                    $(this).data("event", {
                        title: $.trim($(this).text()),
                        stick: !0,
                        className: $(this).data("color"),
                        description: ""
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
                    height: 600,
                    events: [
                        {
                    title: "New Year's Day",
                    start:  "2019-01-01",
                    description: "New Year's Day",
                    className: "m-fc-event--danger m-fc-event--solid-light"
                },{
                    title: "Chinese New Year",
                    start:  "2019-02-05",
                    description: "Chinese New Year",
                    className: "m-fc-event--danger m-fc-event--solid-light"
                },{
                    title: "Bali Hindu New Year",
                    start:  "2019-03-07",
                    description: "Bali Hindu New Year",
                    className: "m-fc-event--danger m-fc-event--solid-light"
                },{
                    title: "Isra Mi'raj",
                    start:  "2019-04-03",
                    description: "Isra Mi'raj",
                    className: "m-fc-event--danger m-fc-event--solid-light"
                },{
                    title: "Good Friday",
                    start:  "2019-04-19",
                    description: "Good Friday",
                    className: "m-fc-event--danger m-fc-event--solid-light"
                },{
                    title: "Labour Day",
                    start:  "2019-05-01",
                    description: "Labour Day",
                    className: "m-fc-event--danger m-fc-event--solid-light"
                },{
                    title: "Waisak Day",
                    start:  "2019-05-19",
                    description: "Waisak Day",
                    className: "m-fc-event--danger m-fc-event--solid-light"
                },{
                    title: "Ascension Day of Jesus Christ",
                    start:  "2019-05-30",
                    description: "Ascension Day of Jesus Christ",
                    className: "m-fc-event--danger m-fc-event--solid-light"
                },{
                    title: "Pancasila Day",
                    start:  "2019-06-01",
                    description: "Pancasila Day",
                    className: "m-fc-event--danger m-fc-event--solid-light"
                },{
                    title: "Lebaran Holiday",
                    start:  "2019-06-03",
                    end: "2019-06-04",
                    description: "Lebaran Holiday",
                    className: "m-fc-event--danger m-fc-event--solid-light"
                },{
                    title: "Hari Raya Idul Fitri",
                    start:  "2019-06-05",
                    end: "2019-06-06",
                    description: "Hari Raya Idul Fitri",
                    className: "m-fc-event--danger m-fc-event--solid-light"
                },{
                    title: "Lebaran Holiday",
                    start:  "2019-06-07",
                    description: "Lebaran Holiday",
                    className: "m-fc-event--danger m-fc-event--solid-light"
                },{
                    title: "Idul Adha",
                    start:  "2019-08-11",
                    description: "Idul Adha",
                    className: "m-fc-event--danger m-fc-event--solid-light"
                },{
                    title: "Independence Day",
                    start:  "2019-08-17",
                    description: "Independence Day",
                    className: "m-fc-event--danger m-fc-event--solid-light"
                },{
                    title: "Islamic New Year",
                    start:  "2019-09-01",
                    description: "Islamic New Year",
                    className: "m-fc-event--danger m-fc-event--solid-light"
                },{
                    title: "Prophet Muhammad's Birthday",
                    start:  "2019-11-09",
                    description: "Prophet Muhammad's Birthday",
                    className: "m-fc-event--danger m-fc-event--solid-light"
                },{
                    title: "Christmas Holiday",
                    start:  "2019-12-24",
                    description: "Christmas Holiday",
                    className: "m-fc-event--danger m-fc-event--solid-light"
                },{
                    title: "Christmas Day",
                    start:  "2019-12-25",
                    description: "Christmas Day",
                    className: "m-fc-event--danger m-fc-event--solid-light"
                },{
                    title: "New Year's Day",
                    start:  "2020-01-01",
                    description: "New Year's Day",
                    className: "m-fc-event--danger m-fc-event--solid-light"
                },{
                    title: "Chinese New Year",
                    start:  "2020-02-25",
                    description: "Chinese New Year",
                    className: "m-fc-event--danger m-fc-event--solid-light"
                },{
                    title: "Bali Hindu New Year",
                    start:  "2020-03-25",
                    description: "Bali Hindu New Year",
                    className: "m-fc-event--danger m-fc-event--solid-light"
                },{
                    title: "Isra Mi'raj",
                    start:  "2020-03-22",
                    description: "Isra Mi'raj",
                    className: "m-fc-event--danger m-fc-event--solid-light"
                },{
                    title: "Good Friday",
                    start:  "2020-04-10",
                    description: "Good Friday",
                    className: "m-fc-event--danger m-fc-event--solid-light"
                },{
                    title: "Labour Day",
                    start:  "2020-05-01",
                    description: "Labour Day",
                    className: "m-fc-event--danger m-fc-event--solid-light"
                },{
                    title: "Waisak Day",
                    start:  "2020-05-07",
                    description: "Waisak Day",
                    className: "m-fc-event--danger m-fc-event--solid-light"
                },{
                    title: "Ascension Day of Jesus Christ",
                    start:  "2020-05-21",
                    description: "Ascension Day of Jesus Christ",
                    className: "m-fc-event--danger m-fc-event--solid-light"
                },{
                    title: "Pancasila Day",
                    start:  "2020-06-01",
                    description: "Pancasila Day",
                    className: "m-fc-event--danger m-fc-event--solid-light"
                },{
                    title: "Lebaran Holiday",
                    start:  "2020-05-22",
                    description: "Lebaran Holiday",
                    className: "m-fc-event--danger m-fc-event--solid-light"
                },{
                    title: "Hari Raya Idul Fitri",
                    start:  "2020-05-24",
                    end: "2020-05-26",
                    description: "Hari Raya Idul Fitri",
                    className: "m-fc-event--danger m-fc-event--solid-light"
                },{
                    title: "Lebaran Holiday",
                    start:  "2020-05-26",
                    description: "Lebaran Holiday",
                    className: "m-fc-event--danger m-fc-event--solid-light"
                },{
                    title: "Idul Adha",
                    start:  "2020-07-31",
                    description: "Idul Adha",
                    className: "m-fc-event--danger m-fc-event--solid-light"
                },{
                    title: "Independence Day",
                    start:  "2020-08-17",
                    description: "Independence Day",
                    className: "m-fc-event--danger m-fc-event--solid-light"
                }

                // show leave employee from DB    

                @foreach($leaves as $leave)
                    ,{
                    title: "{{$leave->users->name}}",
                    start:  "{{$leave->from}}",
                    end: "{{$leave->to}}T23:59:00",
                    description: "{{$leave->reason}}",
                    className: "m-fc-event--light m-fc-event--solid-success"
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

    {{-- For calculate duration for calender datepicker --}}
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

        async function getBusinessDatesCount(startDate, endDate) {
            var count = 1;
            var curDate = new Date(startDate);
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
                    if(curDate.valueOf() == new Date(item).valueOf()){
                        isExistThisYear = true;
                        return; 
                    }
                })  
                
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