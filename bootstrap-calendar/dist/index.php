<!DOCTYPE html>
<html lang="en" >
<head>
 
<meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dwell Monitoring System</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../../images/logodwell.png" rel="icon">
  <link href="../../images/logodwell.png" rel="apple-touch-icon">

  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.2/css/bootstrap.min.css'><link rel="stylesheet" href="./style.css">

  <?php
  include("../../admin/header.php");
  ?>
</head>
<body>
<!-- partial:index.partial.html
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
 -->
<script src="script.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>

<head>
  <script>
    $(document).ready(function() {
      var date = new Date();
      var d = date.getDate();
      var m = date.getMonth();
      var y = date.getFullYear();
      /*  className colors
		
      className: default(transparent), important(red), chill(pink), success(green), info(blue)
		
      */
      /* initialize the external events
      -----------------------------------------------------------------*/
      $('#external-events div.external-event').each(function() {
        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
        // it doesn't need to have a start or end
        var eventObject = {
          title: $.trim($(this).text()) // use the element's text as the event title
        };
        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject);
        // make the event draggable using jQuery UI
        $(this).draggable({
          zIndex: 999,
          revert: true, // will cause the event to go back to its
          revertDuration: 0 //  original position after the drag
        });
      });
      /* initialize the calendar
      -----------------------------------------------------------------*/
      var calendar = $('#calendar').fullCalendar({
        header: {
          left: 'title',
          center: 'agendaDay,agendaWeek,month',
          right: 'prev,next today'
        },
        editable: true,
        firstDay: 0, //  1(Monday) this can be changed to 0(Sunday) for the USA system
        selectable: true,
        defaultView: 'month',
        axisFormat: 'h:mm',
        columnFormat: {
          month: 'ddd', // Mon
          week: 'ddd d', // Mon 7
          day: 'dddd M/d', // Monday 9/7
          agendaDay: 'dddd d'
        },
        titleFormat: {
          month: 'MMMM yyyy', // September 2009
          week: "MMMM yyyy", // September 2009
          day: 'MMMM yyyy' // Tuesday, Sep 8, 2009
        },
        allDaySlot: false,
        selectHelper: true,
        select: function(start, end, allDay) {
          var title = prompt('Event Title:');
          if (title) {
            calendar.fullCalendar('renderEvent', {
                title: title,
                start: start,
                end: end,
                allDay: allDay
              },
              true // make the event "stick"
            );
          }
          calendar.fullCalendar('unselect');
        },
        droppable: true, // this allows things to be dropped onto the calendar !!!
        drop: function(date, allDay) { // this function is called when something is dropped
          // retrieve the dropped element's stored Event Object
          var originalEventObject = $(this).data('eventObject');
          // we need to copy it, so that multiple events don't have a reference to the same object
          var copiedEventObject = $.extend({}, originalEventObject);
          // assign it the date that was reported
          copiedEventObject.start = date;
          copiedEventObject.allDay = allDay;
          // render the event on the calendar
          // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
          $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
          // is the "remove after drop" checkbox checked?
          if ($('#drop-remove').is(':checked')) {
            // if so, remove the element from the "Draggable Events" list
            $(this).remove();
          }
        },
        events: [
          {
            title: 'sample',
            start: new Date(y, m, 12, 8, 0),
            allDay: false,
            className: 'important'
          }
        ],
      });
    });
  </script>
  <style>


    #wrap {
      width: 1100px;
      margin: 0 auto;
    }

    #external-events {
      float: left;
      width: 150px;
      padding: 0 10px;
      text-align: left;
    }

    #external-events h4 {
      font-size: 16px;
      margin-top: 0;
      padding-top: 1em;
    }

    .external-event {
      /* try to mimick the look of a real event */
      margin: 10px 0;
      padding: 2px 4px;
      background: #3366CC;
      color: #fff;
      font-size: .85em;
      cursor: pointer;
    }

    #external-events p {
      margin: 1.5em 0;
      font-size: 11px;
      color: #666;
    }

    #external-events p input {
      margin: 0;
      vertical-align: middle;
    }

   
  </style>
</head>

<body>

<section class="section dashboard">
<div class="row">
    <!-- Sales Card -->
            <div class="col-xxl-4 col-md-12">
              <div class="card info-card sales-card">

                <div class="card-body">
                  <br>
                  <img src="semsem.png" width="100%" alt="">
                </div>

              </div>
            </div><!-- End Sales Card -->

             <!-- Revenue Card -->
             <div class="col-xxl-4 col-md-12">
              <div class="card info-card revenue-card">

               

                <div class="card-body">
              
                  <div class="d-flex align-items-center">
                  <img src="../../images/logodwell.png" alt="" width="2%"> &nbsp;
                  <a href="../../admin/pets.php"><button type="button" class="btn btn-success" title="Check Pets" ><i class="bi bi-file-medical"></i> Pets</button></a> &nbsp;&nbsp;
                  <a href="../../admin/index.php"><button type="button" class="btn btn-primary" title="back to home" ><i class="bi bi-house"></i> Home</button></a> &nbsp;&nbsp;
                 <a href="" ><button type="button" class="btn btn-warning" title="Consultation Reminders" ><i class="bi bi-calendar-check"></i> Reminders</button></a>
                    
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->
            
            <div class="col-xxl-4 col-md-12">
              <div class="card info-card revenue-card">
              <div class="card-body">

                  <div id='calendar'></div>

                  <div style='clear:both'></div>
                </div>
              </div>
            </div>
              </div>
  </section>
</body>

</html>
<!-- partial -->
  <script src='script.js'></script><script  src="script.js"></script>

  <?php 
  include("../../footer.php");
  ?>
</body>
</html>
