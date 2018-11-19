<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="node_modules/fullcalendar/dist/fullcalendar.css" rel="stylesheet">

    <script type="text/javascript" src="node_modules/jquery/dist/jquery.js"></script>
    <script type="text/javascript" src="node_modules/moment/min/moment-with-locales.js"></script>
    <script type="text/javascript" src="node_modules/moment/locale/sr.js"></script>
    <script type="text/javascript" src="node_modules/fullcalendar/dist/fullcalendar.js"></script>
    <script type="text/javascript" src="node_modules/fullcalendar/dist/locale/sr.js"></script>


<script>
    $(function() {
		
			var conn = new WebSocket('ws://localhost:8080');
				conn.onopen = function(e) {
				console.log("Connection established!");
			};

	        // page is now ready, initialize the calendar...
        var calendar = $('#calendar_goes_here');
		calendar.fullCalendar({
            header: {
                left: 'month,agendaWeek,agendaDay',
                center: 'title'
            },
			events: [
			{
			title: 'Zakazao Pera',
			start: '2018-10-04 10:00',
			end: '2018-10-04 10:30'
			}
    // other events here
  ],

			eventClick: function(calEvent, jsEvent, view) {
				alert('Event: ' + calEvent.title);
				conn.send("{ko:"+calEvent.title+",start:"+calEvent.start+",end:"+calEvent.end);
				// change the border color just for fun
				$(this).css('border-color', 'red');

			}

        });
		
		conn.onmessage = function(e) {
			var myEvent = {
  title:"my new event",
  allDay: true,
  start: new Date(),
  end: new Date()
};
			calendar.fullCalendar("renderEvent", myEvent, true );
			console.log(e.data);
		};
		
    });
</script>
</head>
<body>
<div id="calendar_goes_here"></div>
</body>
</html>
