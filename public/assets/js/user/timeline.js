var calendarEl = document.getElementById('calendar');
var calendar = new FullCalendar.Calendar(calendarEl, {
    headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay'
    },

    locale: "tr",

    selectable: true,
    selectMirror: true,
    select: function(arg) {
        var title = prompt('Event Title:');
        if (title) {
            calendar.addEvent({
                title: title,
                start: arg.start,
                end: arg.end,
                allDay: arg.allDay
            })
        }
        calendar.unselect()
    },

    editable: true,
    droppable: true, // this allows things to be dropped onto the calendar
    drop: function(arg) {
        // is the "remove after drop" checkbox checked?
        if (document.getElementById('drop-remove').checked) {
            // if so, remove the element from the "Draggable Events" list
            arg.draggedEl.parentNode.removeChild(arg.draggedEl);
        }
    },
    initialDate: '2023-03-23',
    weekNumbers: true,
    navLinks: true, // can click day/week names to navigate views
    editable: true,
    selectable: true,
    nowIndicator: true,
    events: [
        {
            title: 'Tatil',
            start: '2023-03-23',
            end: '2023-03-30',
            className: "bg-primary"
        },
        {
            title: 'Yat Turu',
            start: '2023-03-24T12:00:00',
            className: "bg-warning"
        },
        {
            title: 'Aquapark',
            start: '2023-03-25T14:00:00',
            className: "bg-warning"
        },
        {
            title: 'Safari',
            start: '2023-03-26T16:00:00',
            className: "bg-warning"
        },
        {
            title: 'Zipline',
            start: '2023-03-27T15:00:00',
            className: "bg-warning"
        },
        {
            title: 'Bungee Jumping',
            start: '2023-03-29T17:30:00',
            className: "bg-warning"
        }
    ]
});
$('#collapseOne').on('shown.bs.collapse', function () {
    calendar.render();
})
