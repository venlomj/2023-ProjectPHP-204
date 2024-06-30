
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.6/index.global.min.js"></script>
<script> 
            document.addEventListener('DOMContentLoaded', function () {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'timeGridWeek',
                    slotMinTime: '00:00:00',
                    slotMaxTime: '24:00:00',
                    eventMinHeight: '80',
                    nowIndicator: 'true',
                    events: @json($events),
                });
                calendar.render();
            });
        </script>
                <script> 
            document.addEventListener('DOMContentLoaded', function () {
                var calendarEl2 = document.getElementById('calendar2');
                var calendar2 = new FullCalendar.Calendar(calendarEl2, {
                    initialView: 'timeGrid',
                    slotMinTime: '00:00:00',
                    slotMaxTime: '24:00:00',
                    nowIndicator: 'true',
                    events: @json($events),
                });
                calendar2.render();
            });
            </script>
<x-zwemclub-layout>
    <body>
        <div class="lg:block hidden" id='calendar'></div>
        <div class="lg:hidden" id='calendar2'></div>
    </body>
</x-zwemclub-layout>