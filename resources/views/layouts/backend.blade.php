<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title')</title>
  <!-- Favicon -->
  <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon">
  <!-- Web Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <base href="{{ url('/') }}">
  <!-- jQuery library -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
  <!-- Theme Styles -->
  <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/theme.css') }}">
  <link rel="stylesheet" href="{{ asset('css/print.css') }}" media="print">
  <link rel="stylesheet" href="{{ asset('css/jquery.mCustomScrollbar.css') }}">
  <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
  <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
  <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/core/main.css" rel="stylesheet" crossorigin="anonymous" />
  <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid/main.css" rel="stylesheet" crossorigin="anonymous" />
  <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/timegrid/main.css" rel="stylesheet" crossorigin="anonymous" />
  <!--script src="https://cdn.jsdelivr.net/npm/chart.js"></script-->
  <!-- Custom Charts -->
  <style>
    .js-doughnut-chart {
      width: 70px !important;
      height: 70px !important;
    }
    @media print {
    body * {
        visibility: hidden; /* Hides all content */
    }
    .printable-content, .printable-content * {
        visibility: visible; /* Makes the table content visible */
    }
    .printable-content {
        position: absolute; /* Positions the content for printing */
        top: 0;
        left: 0;
        width: 100%;
    }

    /* Hide all columns by default */
    .printable-content th, .printable-content td {
        display: none;
    }

    /* Show only specific columns */
    .printable-content th:nth-child(1), /* S.No */
    .printable-content td:nth-child(1),
    .printable-content th:nth-child(2), /* Placed On */
    .printable-content td:nth-child(2),
    .printable-content th:nth-child(3), /* Fullfillment */
    .printable-content td:nth-child(3),
    .printable-content th:nth-child(4), /* Name */
    .printable-content td:nth-child(4),
    .printable-content th:nth-child(5), /* Email & Phone number */
    .printable-content td:nth-child(5),
    .printable-content th:nth-child(6), /* Person */
    .printable-content td:nth-child(6),
    .printable-content th:nth-child(7), /* Promo Code */
    .printable-content td:nth-child(7) {
        display: table-cell;
    }

    /* Make headers and text dark */
    .printable-content th, .printable-content td {
        font-weight: bold;
        color: #000; /* Ensure text is dark */
    }

    /* Hide pagination content */
    .pagination, /* If pagination uses this class */
    .printable-content td[colspan], /* If pagination spans across a column */
    .pagination-container, /* Adjust to the actual class used */
    .page-links {
        display: none !important;
    }
}
  </style>
</head>

<body> @include('includes.header_backend') <main class="u-main" role="main"> @include('includes.sidebar') <div class="u-content">
      <div class="u-body"> @yield('content') </div> @include('includes.footer_backend') @yield('scripts')
    </div>
  </main>
  <!-- Event Details Modal -->
  <div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="eventModalLabel">Event Details</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p id="modalBodyContent"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Add New Reservation -->
  <div class="modal fade bd-example-modal-lg" tabindex="-1" id="adr" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New Reservation</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="alert-sucess alert alert-success" style="display:none;"></div>
          <div class="row mb-3" id="eventTypeSelect">
            <div class="col-6">
              <input type="radio" id="newReservation" name="eventType" value="newReservation" checked>
              <label for="newReservation">Add New Reservation</label>
            </div>
            <div class="col-6">
              <input type="radio" id="otherEvents" name="eventType" value="otherEvents">
              <label for="otherEvents">Other Events</label>
            </div>
          </div>

          <div id="newReservationContent">

          <form action="{{ url('update-record') }}" method="post" id="editForm">
              {{ csrf_field() }}
              <div class="row">
                <div class="form-group mb-4 col-4">
                  <label for="defaultInput">Number of Guests</label>
                  <select class="form-control" id="person" name="person">
                    <option class="text-black" value="2">2 People</option>
                    <option class="text-black" value="3">3 People</option>
                    <option class="text-black" value="4">4 People</option>
                    <option class="text-black" value="5">5 People</option>
                    <option class="text-black" value="6">6 People</option>
                    <option class="text-black" value="7">7 People</option>
                    <option class="text-black" value="8">8 People</option>
                    <option class="text-black" value="9">9 People</option>
                    <option class="text-black" value="10">10 People</option>
                  </select>
                </div>
                <div class="form-group mb-4 col-4">
                  <label for="defaultInputdate">Date</label>
                  <input type="date" readonly class="form-control" id="defaultInputdate" name="date">
                </div>
                <div class="form-group mb-4 col-4">
                  <label for="defaultInputime">Time</label>
                  <!-- <input type="time" class="form-control" id="defaultInputime" name="event_time" style="display: none"> -->
                  <select
                    name="event_time"
                    required
                    id="defaultInputime"
                    class="form-control"
                  >
                  </select>
                </div>
                <div class="form-group mb-4 col-6">
                  <label for="defaultInputfname">First Name</label>
                  <input type="text" class="form-control @error('name') is-invalid @enderror" id="firstname" name="firstname" value="{{ old('name') }}">
                </div>
                <div class="form-group mb-4 col-6">
                  <label for="defaultInputlastname">Last Name</label>
                  <input type="text" class="form-control @error('lastname') is-invalid @enderror" id="lastname" name="lastname" value="{{ old('lastname') }}">
                </div>
                <div class="form-group mb-4 col-6">
                  <label for="defaultInputphone">Phone Number</label>
                  <input type="text" class="form-control" id="defaultInputphone" maxlength="10" name="phone">
                </div>
                <div class="form-group mb-4 col-6">
                  <label for="email">Email Address</label>
                  <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
                </div>
                <div class="form-group mb-4 col-6">
                  <label for="defaultInputocc">Select An Occasion</label>
                  <select class="form-control" name="occasion" id="defaultInputocc">
                    <option value="Select An Occasion">Select An Occasion</option>
                    <option value="Birthday Party">Birthday Party</option>
                    <option value="Anniversary Party">Anniversary Party</option>
                    <option value="Other">Other</option>
                  </select>
                </div>
                <div class="form-group mb-4 col-6 promocode" style="display: none;">
                  <label for="defaultInputocc">Promocode</label>
                  <select class="form-control" name="promocode" id="promocode">
                    <option value="No">No</option>
                    <option value="Yes">Yes</option>
                  </select>
                </div>
                <div class="form-group mb-4 col-12 comment">
                  <label for="defaultInput">Add A Special Request</label>
                  <textarea class="form-control" id="eventName" name="comment"></textarea>
                </div>
              </div>
          </div>

          <div id="otherEventsContent" style="display:none;">
            <input type="hidden" name="guest_emails" id="guestEmails">
            <!-- Add content for other events here -->
            <div class="row">
              <div class="form-group mb-4 col-12">
                <label for="otherEventDetails">Event Details</label>
                <textarea class="form-control" id="otherEventDetails" name="event_details"></textarea>
              </div>
              <div class="form-group mb-4 col-6">
                <label for="defaultInputdate">Date</label>
                <input type="date" class="form-control" readonly id="defaultEventdate" name="event_date">
              </div>
              <div class="form-group mb-4 col-6">
                <label for="defaultInputime">Time</label>
                <!-- <input type="time" class="form-control" id="defaultInputime" name="event_time" style="display: none"> -->
                <select
                  name="event_time"
                  required
                  id="defaultInputime"
                  class="form-control"
                >
                </select>
              </div>
              <div class="form-group mb-4 col-6">
                <label for="email">Add Guests</label>
                <div class="input-group">
                  <input type="email" class="form-control" id="guestEmail" name="guestEmail">
                  <div class="input-group-append">
                    <button type="button" class="btn btn-primary" id="addGuestEmailButton">Add</button>
                  </div>
                </div>
                <div id="guestList" class="mt-2"></div>
              </div>
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-secondary">Submit</button>
          </div>
        </form>
        </div>
              <script>
          document.addEventListener('DOMContentLoaded', function () {
              const form = document.getElementById('editForm');

              form.addEventListener('submit', async function (e) {
                  e.preventDefault(); // Prevent default form submission

                  // Collect form data
                  const formData = new FormData(form);

                  try {
                      const response = await fetch("https://tfcmockup.com/admin/api/book-table", {
                          method: "POST",
                          body: formData,
                      });

                      // Parse the JSON response
                      const result = await response.json();

                      if (response.ok) {
                          // Success handling
                          console.log(result);
                          alert(result.msg || "Booking added successfully!");
                      } else {
                          // Error handling
                          console.error('Error:', result);
                          alert(result.error || "Something went wrong!");
                      }
                  } catch (error) {
                      // Network or other errors
                      console.error('Fetch Error:', error);
                      alert("Failed to submit the form. Please try again.");
                  }
              });
          });
      </script>
        <script>
          document.getElementById('newReservation').addEventListener('change', function() {
            document.getElementById('newReservationContent').style.display = 'block';
            document.getElementById('otherEventsContent').style.display = 'none';
          });

          document.getElementById('otherEvents').addEventListener('change', function() {
            document.getElementById('newReservationContent').style.display = 'none';
            document.getElementById('otherEventsContent').style.display = 'block';
          });

          document.getElementById('addGuestEmailButton').addEventListener('click', function() {
            var email = document.getElementById('guestEmail').value;
            if (email) {
              var emailList = document.getElementById('guestList');
              var emailItem = document.createElement('div');
              emailItem.className = 'guest-email-item';
              emailItem.innerText = email;
              emailList.appendChild(emailItem);
              document.getElementById('guestEmail').value = '';
              //push email to hidden input
              var hiddenInput = document.getElementById('guestEmails');
              var hiddenInputValue = hiddenInput.value;
              if (hiddenInputValue) {
                hiddenInputValue += ',';
              }
              hiddenInputValue += email;
              hiddenInput.value = hiddenInputValue;
            }
          });
        </script>


      </div>
    </div>
  </div>
  <!-- Add New Reservation -->
  <!-- Edit Reservation -->
  <div class="modal fade bd-example-modal-lgedit" tabindex="-1" id="editModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Reservation</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="alert-sucess1 alert alert-success" style="display:none;"></div>
          <form action="{{ url('update-record') }}" method="post" id="editForm">
            {{ csrf_field() }}
            <div class="row"></div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <input type="submit" class="col-md-3 offset-md-5 btn btn-primary save-btn" value="Submit">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Edit Reservation -->
  <!-- View Reservation -->
  <div class="modal fade bd-example-modal-lgview" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">View Reservation</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- Placeholder for unordered list -->
          <div class="reservation-details"></div>
        </div>
      </div>
    </div>
  </div>
  <!-- View Reservation -->
  <!-- Add your JS scripts here -->
  <!-- Global Vendor -->
  <!-- <script src="js/jquery.min.js"></script> -->
  <!--script src="js/jquery-migrate.min.js"></script-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="{{ asset('js/popper.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap.min.js' )}}"></script>
  <!-- Plugins -->
  <!-- Initialization  -->
  <script src="{{ asset('js/sidebar-nav.js') }}"></script>
  <script src="{{ asset('js/main.js') }}"></script>
  <script src="{{ asset('js/dashboard-page-scripts.js') }}"></script>
  <script src="{{ asset('js/popper.min.js') }}"></script>
  <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('js/custom-owl-carousel.js') }}"></script>
  <script src="{{ asset('js/reply-form.js') }}"></script>
  <script src="{{ asset('js/reservation-calendar.js') }}"></script>
</body>

</html>