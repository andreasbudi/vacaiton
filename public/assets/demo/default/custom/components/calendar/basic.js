var CalendarBasic = {
    init: function() {
        var e = moment().startOf("day"),
            t = e.format("YYYY-MM"),
            i = e.clone().subtract(1, "day").format("YYYY-MM-DD"),
            n = e.format("YYYY-MM-DD"),
            r = e.clone().add(1, "day").format("YYYY-MM-DD");
        $("#m_calendar").fullCalendar({
            header: {
                left: "prev,next today",
                center: "title",
                right: "month,agendaWeek,agendaDay,listWeek"
            },
            editable: !0,
            eventLimit: !0,
            navLinks: !0,
            events: [{
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
            }],
            eventRender: function(e, t) {
                t.hasClass("fc-day-grid-event") ? (t.data("content", e.description), t.data("placement", "top"), mApp.initPopover(t)) : t.hasClass("fc-time-grid-event") ? t.find(".fc-title").append('<div class="fc-description">' + e.description + "</div>") : 0 !== t.find(".fc-list-item-title").lenght && t.find(".fc-list-item-title").append('<div class="fc-description">' + e.description + "</div>")
            }
        })
    }
};
jQuery(document).ready(function() {
    CalendarBasic.init()
});