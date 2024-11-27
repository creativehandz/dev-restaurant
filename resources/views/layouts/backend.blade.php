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
          <h5 class="modal-title" id="exampleModalLabel">Add New Reservationn</h5>
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
          <div id="formNotification" class="alert alert-success d-none" role="alert">
              Reservation successfully added!
          </div>


          <form id="editForm" method="post">
              {{ csrf_field() }}
              
              <div class="row">
                <!-- First Name and Last Name in the same line -->
                <div class="form-group mb-4 col-md-6">
                  <label for="firstname">First Name</label>
                  <input type="text" class="form-control" id="firstname" name="firstname">
                </div>
                <div class="form-group mb-4 col-md-6">
                  <label for="lastname">Last Name</label>
                  <input type="text" class="form-control" id="lastname" name="lastname">
                </div>
              </div>

              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
              </div>

              <div class="row">
                <!-- Country Code and Phone Number in the same line -->
                <div class="form-group mb-4 col-md-6">
                  <label for="countryCode">Country Code</label>
                  <input type="text" class="form-control" id="countryCode" name="countryCode">
                </div>
                <div class="form-group mb-4 col-md-6">
                  <label for="phone">Phone Number</label>
                  <input type="text" class="form-control" id="phone" name="phone">
                </div>
              </div>

              <div class="row">
                <!-- Date and Time in the same line -->
                <div class="form-group mb-4 col-md-6">
                  <label for="date">Date</label>
                  <input type="date" class="form-control" id="date" name="date">
                </div>
                <div class="form-group mb-4 col-md-6">
                  <label for="time">Time</label>
                  <input type="time" class="form-control" id="time" name="time">
                </div>
              </div>
               
              
              <div class="row">          
              <div class="form-group mb-4 col-md-4">
                <label for="person">Number of Guests</label>
                <select class="form-control" id="person" name="person">
                  <option value="2">2 People</option>
                  <option value="3">3 People</option>
                  <option value="4">4 People</option>
                  <option value="5">5 People</option>
                  <option value="6">6 People</option>
                  <option value="7">7 People</option>
                  <option value="8">8 People</option>
                  <option value="9">9 People</option>
                  <option value="10">10 People</option>
                  <!-- Add more options as needed -->
                </select>
              </div>
                         
              <div class="form-group mb-4 col-md-4">
                <label for="occasion">Occasion</label>
                <select class="form-control" id="occasion" name="occasion">
                  <option value="Birthday Party">Birthday Party</option>
                  <option value="Anniversary Party">Anniversary Party</option>
                  <option value="Other">Other</option>
                </select>
              </div>

              <div class="form-group mb-4 col-md-4">
                <label for="promocode">Promocode</label>
                <input type="text" class="form-control" id="promocode" name="promocode">
              </div>
          </div>
              
              <div class="form-group">
                <label for="comments">Comments</label>
                <textarea class="form-control" id="comments" name="comments"></textarea>
              </div>
              
              
              <input type="hidden" name="promo" value="no">
              <input type="hidden" name="source" value="web">
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
              <script>
              document.addEventListener("DOMContentLoaded", () => {
              const form = document.getElementById("editForm");

              if (!form) {
                console.error("Form not found.");
                return;
              }

              form.addEventListener("submit", function (event) {
                event.preventDefault(); // Prevent default form submission

                const formData = new FormData(form);
                const jsonData = {};

                // Convert FormData to JSON object
                formData.forEach((value, key) => {
                  jsonData[key] = value;
                });

                console.log("Sending JSON Data:", jsonData);

    // Simulate form submission (replace with actual fetch logic)
    fetch("https://tfcmockup.com/admin/api/book-table", {
        method: "POST",
        body: new FormData(this),
    })
        .then((response) => {
            if (response.ok) {
                // Show success notification
                const notification = document.getElementById("formNotification");
                notification.textContent = "Reservation successfully added!";
                notification.classList.remove("d-none");
                notification.classList.add("alert-success");

                // Close modal after a short delay
                setTimeout(() => {
                    $(".bd-example-modal-lg").modal("hide");
                    notification.classList.add("d-none");
                }, 2000);
            } else {
                throw new Error("Failed to add reservation");
            }
        })
        .catch((error) => {
            // Show error notification
            const notification = document.getElementById("formNotification");
            notification.textContent = "Error: " + error.message;
            notification.classList.remove("d-none");
            notification.classList.add("alert-danger");
        });
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
          <form>
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