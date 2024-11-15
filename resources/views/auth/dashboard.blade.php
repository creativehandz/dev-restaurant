@extends('layouts.backend')

@section('content')
<script src='https://cdn.jsdelivr.net/npm/fullcalendar/index.global.min.js'></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>


<div class="">

    <div class="row">
        <div class="col-md-3 col-xl-3 mb-4">
            <div class="card-dashboard h-100">
                <div class="card-body media align-items-center px-xl-3 flex-fill">       
                    <div class="media-body">
                        <div class="row  justify-content-between">
                            <div class="col-md-10 col-lg-10 col-xl-9 col-xxl-10">
                        <h4 class="h4 text-muted mb-2">
                            Total Bookings from Admin:
                        </h4>
                        </div>
                        <div class="col-md-2 col-lg-2 col-xl-3 col-xxl-2 text-right">
                        <i class="fa fa-arrow-up text-white custom-icon"></i>
                        </div>
                        </div>
                        <h2 class="h2 font-weight-bold mb-2">{{ $adminCustomers }}</h2>
                        {{-- <h5 class="h5 mb-2"><i class="fa fa-arrow-circle-up text-white mr-1"></i> 8.2%</h5> --}}
                        <div class="pt-4 pb-5"></div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-9 mb-4">
            <div class="card h-100">
                <div class="card-body bg-white d-flex align-items-center custom-text">
                    <div class="d-flex justify-content-between w-100">
                        <div class="col-md-2 d-flex flex-column mr-3">
                            <h4 class="h4 mb-2">Total Bookings</h4>
                            <h1 class="h1 font-extrabold mb-4">{{ $adminCustomers + $webCustomers + $whatsappCustomers}}</h1>
                            {{-- <h5 class="h5 mt-5"><i class="fa fa-arrow-circle-up mr-1"></i> 8.2%</h5> --}}
                        </div>
                        <div class="col-md-10">
                            <canvas id="barChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-sm-3 col-xl-3 mb-4">
            <!-- Total Expense -->
            <div class="card mb-4">
                <div class="card-body-wrap media align-items-center px-xl-3 custom-text">
                    <div class="media-body">
                        <div class="row justify-content-between">
                            <div class="col-9">
                                <h4 class="h4 text-muted mb-2">
                                    Total Bookings from Web: 
                                </h4>
                            </div>
                            <div class="col-3 text-right">
                                <i class="fa fa-arrow-up text-white  custom-icon"></i>
                            </div>
                        </div>
                        <h1 class="h1 font-extrabold mt-5 mb-0">{{ $webCustomers }}</h1>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body-wrap media align-items-center px-xl-3 custom-text">
                    <div class="media-body">
                        <div class="row justify-content-between">
                            <div class="col-9">
                                <h4 class="h4 text-muted mb-2">
                                    Total Bookings from WhatsApp: 
                                </h4>
                            </div>
                            <div class="col-3 text-right">
                                <i class="fa fa-arrow-up text-white  custom-icon"></i>
                            </div>
                        </div>
                        <h1 class="h1 font-extrabold mt-5 mb-0">{{ $whatsappCustomers }}</h1>
                    </div>
                </div>
            </div>
            

            <!-- Sales History -->
            {{-- <div class="card mb-4">
                <div class="card-body media align-items-center px-xl-3 custom-text">
                    <div class="media-body">
                        <div class="row justify-content-between">
                            <div class="col-7">
                                <h4 class="h4 text-muted mb-2">
                                    Sales History
                                </h4>
                            </div>
                            <div class="col-5 text-right">
                                <p class="h6"><a href="#" class="btn btn-warning btn-sm">View all</a></p>
                            </div>
                        </div>
                        <span class="h6 font-extrabold mb-0">List Here</span>
                    </div>
                </div>
            </div> --}}
        </div>
 
        <!-- Customers List -->
        <div class="col-sm-9 mb-4">
            <div class="card mb-4">
            <header class="card-header">
                <div class="row">
                    <div class="col-7 col-md-9">
                        <h2 class="h3 card-header-title">Customers List</h2>
                    </div>
                    <div class="col-5 col-md-3 text-end" style="text-align:right;">
                        <a id="sendEmailBtn" class="btn btn-success custom-btn" href="#">Send Email</a>
                    </div>
                </div>
            </header>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead style="background:#333333;">
                                <tr>
                                    <th class="px-4 py-3">Select</th>
                                    <th class="px-4 py-3">S.No</th>
                                    <th class="px-4 py-3">First Name</th>
                                    <th class="px-4 py-3">Email</th>
                                    <th class="px-4 py-3">Phone</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ordr as $key => $odr)
                                    <tr class="p-2">
                                        <td class="px-4 py-3"><input type="checkbox" name="emails[]" class="customer-checkbox" value="{{ $odr->email }}"></td>
                                        <td class="px-4 py-3">{{ $key+1 }}</td>
                                        <td class="px-4 py-3">{{$odr->firstname}}</td>
                                        <td class="px-4 py-3">{{$odr->email}}</td>
                                        <td class="px-4 py-3">{{$odr->phone}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <p>{{ $ordr->links() }}</p>
                </div>
            </div>
        </div>
    </div>



    <div class="row">
        <div class="col-sm-12 col-xl-12 mb-4">
            <div class="card mb-4">

                <div class="card-body bg-white" style="border-radius:30px;">
                    <div id="calendar"></div>
                </div>

            </div>
        </div>
    </div>
    <!-- End Doughnut Chart -->




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
                    }else if (selectedOption == 'otherEvents') {
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

<script>
    const barctx = document.getElementById('barChart');
    new Chart(barctx, {
        type: 'bar',
        data: {
            labels: ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'],
            datasets: [{
                label: '',
                data: @json($total_bookings),
                borderColor: 'rgb(255, 99, 132)',
                backgroundColor: 'rgba(255, 99, 132, 0.5)',
                borderWidth: 2,
                borderRadius: 5,
                borderSkipped: false,
                
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
        x: {
          grid: {
            display: false,
          },
          ticks: {
                        color: '#FF6347', // Customize the label color for x-axis
                        font: {
                            size: 14,
                            weight: 'normal',
                        }
                    }
        },
        y: {
          grid: {
            display: false,
          },
          ticks:{
            display: false,
          }
        },
      },
            plugins: {
                legend: {
                    display: false,
                    position: 'left',
                },
                tooltip: {
                    enabled : true, // Disable tooltips
                },
                title: {
                    display: false,
                    text: ''
                },
                datalabels: {
                    anchor: 'end',
                    align: 'top',
                    formatter: function(value, context) {
                        return  value;
                    },
                    color: '#4B0082',
                    font: {
                        weight: 'bold',
                        size: 14,
                    },
                    offset: -4,
                }
            },
        },
        plugins: [ChartDataLabels]
    });
</script>


<!-- send email to selected customers -->
<script>
document.getElementById('sendEmailBtn').addEventListener('click', function(event) {
  event.preventDefault();
  var checkboxes = document.querySelectorAll('.customer-checkbox:checked');
  var emails = [];
  checkboxes.forEach(function(checkbox) {
    emails.push(checkbox.value);
  });

  if (emails.length === 0) {
    alert('Please select at least one customer to send an email.');
  } else {
    $.ajax({
      type: "POST",
      url: "{{ url('/api/send-email') }}",
      data: {
        emails: emails 
      },
      success: function(response) {
        console.log('Success', response);
        alert(response.success); // Notify user of success
      },
      error: function(response) {
        if (response.responseJSON && response.responseJSON.errors) {
          console.log(response.responseJSON.errors); // Log any validation errors
        } else {
          console.log('Error:', response);
          alert('An error occurred while sending emails.');
        }
      }
    });

  }
});
</script>


@endsection