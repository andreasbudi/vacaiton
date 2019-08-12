var CalendarExternalEvents = function () {
    var t = function () {
        $("#m_calendar_leave .fc-event").each(function () {
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
        e = function () {
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
                events: [{

                    title: "Idul Adha",
                    start: "2019-08-11",
                    end:"2019-08-13",
                    description: "Idul Adha",
                    className: "m-fc-event--danger m-fc-event--solid-warning"

                },],
                editable: !0,
                droppable: !0,
                drop: function (t, e, i, r) {
                    var n = $.fullCalendar.moment(t.format());
                    n.stripTime(), n.time("08:00:00");
                    var a = $.fullCalendar.moment(t.format());
                    a.stripTime(), a.time("12:00:00"), $(this).data("event").start = n, $(this).data("event").end = a, $("#m_calendar_leave_remove").is(":checked") && $(this).remove()
                },
                eventRender: function (t, e) {
                    e.hasClass("fc-day-grid-event") ? (e.data("content", t.description), e.data("placement", "top"), mApp.initPopover(e)) : e.hasClass("fc-time-grid-event") ? e.find(".fc-title").append('<div class="fc-description">' + t.description + "</div>") : 0 !== e.find(".fc-list-item-title").lenght && e.find(".fc-list-item-title").append('<div class="fc-description">' + t.description + "</div>")
                }
            })
        };
    return {
        init: function () {
            t(), e()
        }
    }
}();
jQuery(document).ready(function () {
    CalendarExternalEvents.init()
});