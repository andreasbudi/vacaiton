@extends('layouts.app')
@section('content')

        <div class="row">
                <div class="col-xl-6">
                    <!--begin:: Widgets/Tasks -->
                    <div class="m-portlet m-portlet--full-height ">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">
                                        Apply Form Leave
                                        ({{ (Auth::user()->leaves_available) }} Leaves Ballance to Apply)</h5>
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
                                            <input type="date" name="from" id="from" class="form-control">
                                        </div>
                                        <br>
                                        <div class="col-md-12">
                                            <strong>Duration :</strong>
                                            {{-- <input type="text" name="duration" id="duration" class="form-control"> --}}
                                            <select name="duration" id="duration" class="form-control" onchange="run(this.value)">
                                            <script>
                                            function run(val) {
                                                document.getElementById("from").addEventListener("click", function() {	
                                                var formDuration = document.getElementById("duration");
                                                var getDuration = formDuration.options[formDuration.selectedIndex].value;
                                                // alert(getDuration);
                                                
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
                                        <br>
                                        <div class="col-md-12">
                                            <strong>To :</strong>
                                            {{-- <input type="date" name="to" id="to" class="form-control"> --}}
                                            <input type="text" name="to" id="to" class="form-control">
                                        </div>
                                        <br>
                                        <div class="col-md-12">
                                            <strong>Reason :</strong>
                                            <textarea class="form-control" name="reason" rows="2" cols="80"></textarea>
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
                                        Calendar of Holidays and Leave Record
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
@endsection

@push('scripts')
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

                @foreach($leaves as $leave)
                    ,{
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
@endpush