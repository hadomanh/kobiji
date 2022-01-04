@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    @if (Auth::user()->role == 'student')
    <div class="card card-primary">
        <div class="card-body p-0">
            <!-- THE CALENDAR -->
            <div id="calendar"></div>
        </div>
        <!-- /.card-body -->
    </div>
    @else
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
    @endif
    
</div>

@endsection

@push('script')
<!-- fullCalendar 2.2.5 -->
<script src="{{ asset('bower_components/admin-lte/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('bower_components/admin-lte/plugins/fullcalendar/main.js') }}"></script>
<script type="text/javascript">
    console.log({!! $timetable !!})
    const timetable = {!! $timetable !!}
    let events = []
    timetable.forEach(element => {
        events.push({
            title: element.title,
            start: new Date(element.from),
            end: new Date(element.to),
            backgroundColor: element.backgroundColor,
            borderColor: element.borderColor,
            allDay: false,

        })
    });
    $(function () {
        
        var date = new Date();
        var d = date.getDate(),
            m = date.getMonth(),
            y = date.getFullYear();

        var Calendar = FullCalendar.Calendar;

        var calendarEl = document.getElementById("calendar");

        var calendar = new Calendar(calendarEl, {
            headerToolbar: {
                left: "prev,next today",
                center: "title",
                right: "dayGridMonth,timeGridWeek,timeGridDay",
            },
            themeSystem: "bootstrap",
            //Random default events
            // events: [
            //     {
            //         title: "All Day Event",
            //         start: new Date(y, m, 1),
            //         backgroundColor: "#f56954", //red
            //         borderColor: "#f56954", //red
            //         allDay: true,
            //     },
            //     {
            //         title: "Long Event",
            //         start: new Date(y, m, d - 5),
            //         end: new Date(y, m, d - 2),
            //         backgroundColor: "#f39c12", //yellow
            //         borderColor: "#f39c12", //yellow
            //     },
            //     {
            //         title: "Meeting",
            //         start: new Date(y, m, d, 10, 30),
            //         allDay: false,
            //         backgroundColor: "#0073b7", //Blue
            //         borderColor: "#0073b7", //Blue
            //     },
            //     {
            //         title: "Lunch",
            //         start: new Date(y, m, d, 12, 0),
            //         end: new Date(y, m, d, 14, 0),
            //         allDay: false,
            //         backgroundColor: "#00c0ef", //Info (aqua)
            //         borderColor: "#00c0ef", //Info (aqua)
            //     },
            //     {
            //         title: "Birthday Party",
            //         start: new Date(y, m, d + 1, 19, 0),
            //         end: new Date(y, m, d + 1, 22, 30),
            //         allDay: false,
            //         backgroundColor: "#00a65a", //Success (green)
            //         borderColor: "#00a65a", //Success (green)
            //     },
            //     {
            //         title: "Click for Google",
            //         start: new Date(y, m, 28),
            //         end: new Date(y, m, 29),
            //         url: "https://www.google.com/",
            //         backgroundColor: "#3c8dbc", //Primary (light-blue)
            //         borderColor: "#3c8dbc", //Primary (light-blue)
            //     },
            // ],
            events,
            editable: true,
            droppable: true, // this allows things to be dropped onto the calendar !!!
            drop: function (info) {
                // is the "remove after drop" checkbox checked?
                if (checkbox.checked) {
                    // if so, remove the element from the "Draggable Events" list
                    info.draggedEl.parentNode.removeChild(info.draggedEl);
                }
            },
        });

        calendar.render();
        // $('#calendar').fullCalendar()
    });
</script>

@endpush
