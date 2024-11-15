@extends('layouts.backend')

@section('content')
<script src='https://cdn.jsdelivr.net/npm/fullcalendar/index.global.min.js'></script>

<!-- Start Breadcrumb -->
<div class="mb-4">
    <nav aria-label="breadcrumb">
        <h1 class="h3 text-white">Calender</h1>
        <ol class="breadcrumb bg-transparent small p-0">
            <li class="breadcrumb-item "><a href="./index.html" class="path-color">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Calender</li>
        </ol>
    </nav>
</div>
<!-- End Breadcrumb -->

<div class="card mb-4">

    <div class="card-body bg-white" style="border-radius:30px;">
        <div id="calendar"></div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js" crossorigin="anonymous"></script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        if (calendarEl) {
            console.log('Calendar element found');
            var addReservation = @json($events); // Initialize the events from the server
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                slotMinTime: '07:00:00',
                slotMaxTime: '23:59:59',
                // events: @json($events),
                themeSystem: 'bootstrap4',
                textColor: 'black',
                color: 'yellow',
                center: 'title',
                eventColor: '#378006',
                borderColor: '#000000',
                backgroundColor: '#000000',
                selectable: true,
                selectHelper: true,
                select: function(start, end, allDays) {
                    $('#adr').modal('show');
                    $("#defaultInputdate").val(start.startStr);
                    $("#defaultEventdate").val(start.startStr);
                    
                    // Get the day of the week from the selected start date
                    const selectedDay = new Date(start.startStr).toLocaleDateString(navigator.language, { weekday: 'long', timeZone: "UTC" });
                    
                    // Call getTimeSchedule function and pass the day of the week
                    getTimeSchedule(selectedDay);
                },
                events: function(info, successCallback, failureCallback) {
                    successCallback(addReservation);
                },
                eventClick: function(info) {
                    info.jsEvent.preventDefault(); // prevent browser from following the link in the event

                    // Create a new unordered list element
                    var ul = $('<ul></ul>');

                    // Create list items and append them to the unordered list
                    ul.append('<li>Time: ' + info.event.start + '</li>');
                    ul.append('<li>Name: ' + info.event.title + '</li>');
                    ul.append('<li>Email: ' + info.event.extendedProps.email + '</li>');
                    if(info.event.extendedProps.phone != null)
                        ul.append('<li>Phone: ' + info.event.extendedProps.phone + '</li>');
                    if(info.event.extendedProps.person != null)
                        ul.append('<li>Person: ' + info.event.extendedProps.person + '</li>');
                    if(info.event.extendedProps.promocode != null)
                        ul.append('<li>PromoCode: ' + info.event.extendedProps.promocode + '</li>');
                    if(info.event.extendedProps.occasion != null)
                        ul.append('<li>Occasion: ' + info.event.extendedProps.occasion + '</li>');
                    if(info.event.extendedProps.event_details != null)
                        ul.append('<li>Comments: ' + info.event.extendedProps.comments + '</li>');

                    // Clear any existing content in the modal body and append the unordered list
                    $('#modalBodyContent').empty().append(ul);

                    // Show the modal
                    $('#eventModal').modal('show');
                },
                // headerToolbar: {
                //     left: 'prev,next today',
                //     center: 'title',
                //     right: 'dayGridMonth,timeGridWeek,timeGridDay',

                //     textColor: '#000000' // an option!
                // },
                // titleFormat: {
                //     month: 'short',
                //     year: 'numeric',
                //     day: 'numeric',
                //     weekday: 'long',
                //     textColor: '#000000' // an option!
                // },

                // Responsive Header toolbar
            windowResize: function(view) {
                if (window.innerWidth <= 992) {
                    calendar.setOption('headerToolbar', {
                        left: 'prev,next',
                        center: '',
                        right: 'title',
                        textColor: '#000000' // an option!
                    });
                    calendar.setOption('titleFormat', {
                        month: 'short', // Sep
                        year: 'numeric', // 2023
                        textColor: '#000000' // an option!
                    });
                } else {
                    calendar.setOption('headerToolbar', {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay',
                        textColor: '#000000' // an option!
                    });
                    calendar.setOption('titleFormat', {
                        month: 'short',
                        year: 'numeric',
                        day: 'numeric',
                        weekday: 'long',
                        textColor: '#000000' // an option!
                    });
                }
            }



            });
            calendar.render();

            $("#saveEvent").on("click", function(event) {
                console.log('Save event clicked');
                event.preventDefault(); // Prevent form submission
                var firstname = $("#firstname").val();
                var lastname = $("#lastname").val();
                var title = firstname + " " + lastname;
                var start = $("#defaultInputdate").val();
                var end = $("#defaultInputdate").val();
                var time = $("#defaultInputime").val();
                var email = $("#email").val();
                var phone = $("#defaultInputphone").val();
                var person = $("#person").val();
                if (title && start && end) {
                    addReservation.push({
                        title: title,
                        start: start,
                        end: end,
                        eventColor: '#378006',
                        textColor: 'white',
                        extendedProps: {
                            time: time,
                            email: email, // Add more extended props as needed
                            phone: phone,
                            person: person,
                        }
                    });
                    calendar.refetchEvents();
                    //pushing into DB
                    const selectedOption = $('input[name="eventType"]:checked').val();
                    console.log(selectedOption);
                    var form_data = $("#bookorderh").serialize();
                    if (selectedOption == 'newReservation') {
                        $.ajax({
                            type: "POST",
                            url: "{{ url('/api/book-table') }}",
                            data: form_data,
                            success: function(response) {
                                $("#adr .modal-body .alert-sucess").show();
                                $("#adr .modal-body .alert-sucess").append(response.msg);
                                setTimeout(function() {
                                    $("#adr").modal("hide");
                                    $("#adr .modal-body .alert-sucess").hide();
                                    history.go(0);
                                }, 2000);
                            },
                            error: function(response) {
                                $.each(response.responseJSON.errors, function(field_name, error) {
                                    $(document).find('[name=' + field_name + ']').after('<span class="text-strong text-danger">' + error + '</span>');
                                })
                            }
                        });
                        //$('#adr').modal('hide');
                    } else if (selectedOption == 'otherEvents') {
                        $.ajax({
                            type: "POST",
                            url: "{{ url('/api/create-event') }}",
                            data: form_data,
                            success: function(response) {
                                $("#adr .modal-body .alert-sucess").show();
                                $("#adr .modal-body .alert-sucess").append(response.msg);
                                setTimeout(function() {
                                    $("#adr").modal("hide");
                                    $("#adr .modal-body .alert-sucess").hide();
                                    history.go(0);
                                }, 2000);
                                console.log('Success', response);
                            },
                            error: function(response) {
                                $.each(response.responseJSON.errors, function(field_name, error) {
                                    $(document).find('[name=' + field_name + ']').after('<span class="text-strong text-danger">' + error + '</span>');
                                })
                            }
                        });
                        //$('#adr').modal('hide');
                    }
                } else {
                    alert("Please fill all the fields.");
                }
            });

        } else {
            console.log('No calendar element found');
        }
    });
</script>


@endsection