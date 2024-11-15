<?php

use Carbon\Carbon;
use App\Models\Book;
?> @extends('layouts.backend') @section('content')
<!-- End Breadcrumb -->
<div class="mb-4">
  <nav aria-label="breadcrumb">
    <h1 class="h3 text-white">All reservations</h1>
    <ol class="breadcrumb bg-transparent small p-0">
      <li class="breadcrumb-item">
        <a href="./index.html" class="path-color">Home</a>
      </li>
      <li class="breadcrumb-item active" aria-current="page">Reservations</li>
    </ol>
  </nav>
</div>
<!-- End Breadcrumb -->
<div class="card mb-4">
  <header class="card-header">
    <div class="row">
      <div class="col-5">
        <h2 class="h3 card-header-title">Reservations</h2>
      </div>
      <div class="col-7 text-end" style="text-align:right;">
        <a class="btn btn-success custom-btn" data-toggle="modal" href=".bd-example-modal-lg">Add New Reservation</a>
      </div>
    </div>
  </header>
  <div class="card-body">
    <div class="row">
      <div class="col-13">
        <!-- Custom search input -->
        <form action="{{ route('search_bar_route') }}" method="POST" id="myfm" class="form-inline">
          @csrf
          <div class="form-group col-5 col-md-auto mb-3 mr-3">
          <input type="search" id="customSearchBox" name="search" placeholder="Search..." autocomplete="on" class="form-control custom-input-btn" value="<?php echo isset($search_inputs['search']) ? $search_inputs['search'] : ''; ?>" />
          </div>
            <div class="form-group col-5 col-md-auto mb-3 mr-3">
            <select name="promocode" class="form-control custom-input-btn">
              <option value="" <?php echo isset($search_inputs['promocode']) ? 'selected' : ''; ?>>Promo Code</option>
              <option value="Yes" <?php echo (isset($search_inputs['promocode']) && $search_inputs['promocode'] == 'Yes') ? 'selected' : ''; ?>>Yes</option>
              <option value="No" <?php echo (isset($search_inputs['promocode']) && $search_inputs['promocode'] == 'No') ? 'selected' : ''; ?>>No</option>
            </select>
          </div>
          <div class="form-group col-5 col-md-auto mb-3">
            <label class="mr-1">From</label>
            <input type="date" name="fromdate" value="<?php echo isset($search_inputs['fromdate']) ? $search_inputs['fromdate'] : ''; ?>" class="form-control custom-input-btn">
          </div>
          <div class="form-group col-5 col-md-auto mb-3 mr-3">
            <label class="mr-1 ml-3">To</label>
            <input type="date" name="todate" value="<?php echo isset($search_inputs['todate']) ? $search_inputs['todate'] : ''; ?>" class="form-control custom-input-btn">
          </div>
          <div class="form-group mb-3 mr-3 ml-3">
            <button type="submit" id="getsearch" class="btn btn-light custom-btn text-dark hover:text-dark">Search</button>
          </div>
          <div class="form-group mb-3 mr-3 ">
            <a href="{{ route('todaysrecord') }}" id="fetch-today-records" class="btn btn-success custom-border">Today</a>
            <!--div id="records-container"></div-->

          </div>
          <div class="form-group mb-3 mr-3 ">
            <a href="#" id="" onclick="window.print();return false;" class="btn btn-success custom-border">Print</a>
            <!--div id="records-container"></div-->

          </div>
          <div class="form-group mb-3 ">
            <input type="button" value="Reset" class="btn btn-warning custom-border" onclick="resetAndReload()">
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="card-body ">
    <div class="row">
      <div class="col-12 col-md-12">
        <div class="sucmsg"></div>
      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-hover" id="myTable">
        <thead style="background:#333333;">
          <tr>
            <th scope="col" class="px-4 py-3">S.No</th>
            <th scope="col" class="px-4 py-3">Placed On</th>
            <th scope="col" class="px-4 py-3">Fullfillment</th>
            <th scope="col" class="px-4 py-3">Name</th>
            <th scope="col" class="px-4 py-3">Email & Phone number</th>
            
            <th scope="col" class="px-4 py-3">Person</th>
            <th scope="col" class="px-4 py-3">Promo Code</th>
            <!-- <th scope="col" class="px-4 py-3">Promo</th> -->
            <th scope="col" class="px-4 py-3">Status</th>
            <th scope="col" class="px-4 py-3">Action</th>
          </tr>
        </thead>
        <tbody> @if(count($orders) > 0) @foreach($orders as $key => $order) <tr>
            <td class="px-4 py-3">{{ $loop->iteration }}</td>
            <td class="px-4 py-3"> <?php
                                    $createdAt = Carbon::parse($order->created_at);
                                    $formattedDate = $createdAt->format('D d M');
                                    $formattedTime = $createdAt->format('h:i A'); // Use 'h:i A' for 12-hour format with AM/PM
                                    echo "{$formattedDate} - {$formattedTime}";
                                    ?> </td>
            <td class="px-4 py-3">
              <!-- {{$order->date}} &nbsp;  -->
              <?php
              $createdAt = Carbon::parse($order->date);
              $formattedDate = $createdAt->format('D d M');
              $formattedTime = $createdAt->format('h:i A'); // Use 'h:i A' for 12-hour format with AM/PM
              echo "{$formattedDate} - {$formattedTime}";
              ?>
            </td>
            <td class="px-4 py-3">{{$order->firstname}}&nbsp;{{$order->lastname}} </td>
            <td class="px-4 py-3">{{$order->email}}<br>{{$order->countryCode}} {{$order->phone}}</td>
            
            <td class="px-4 py-3">{{$order->person}}</td>
            <td class="px-4 py-3">{{$order->promocode}}</td>
            <!-- <td class="px-4 py-3"> @if($order->promo)
              {{$order->promo}}
            @else
              Not Available
            @endif

            @php
            $acceptContentSid = "HX839850749b368b0e15a58d4b04de09f2";
            $rejectContentSid = "HXd59bb0d55e7ec48c86f93f57bdaca898";
            @endphp
          </td> -->
            <td class="px-4 py-3">@if($order->status == '1') <span class="text-success">Accept</span> @elseif($order->status == '2') <span class="text-danger">Cancel</span> @else <span class="text-warning">Pending</span> @endif </td>
            <td class="px-4 py-3">

              <button type="button" href="javascript:;" class="btn btn-sm btn-soft-info update-status-btn" data-id="{{ $order->id }}" data-country-code="{{$order->countryCode}}" data-phone="{{$order->phone}}" data-action="accept">Accept</button>
              <button type="button" href="javascript:;" class="btn btn-sm btn-soft-info cancl-status-btn" data-id="{{ $order->id }}" data-country-code="{{$order->countryCode}}" data-phone="{{$order->phone}}" data-action="reject">Reject</button>
              {{-- <button type="button" href="javascript:;" data-id="{{ $order->id }}" class="btn btn-sm btn-soft-info update-status-btn">Accept</button>
              <button type="button" href="javascript:;" data-id="{{ $order->id }}" class="btn btn-sm btn-soft-info cancl-status-btn">Reject</button><br><br> --}}
              <button type="button" data-id="{{$order->id}}" class="btn btn-sm btn-soft-info views">View</button>
              <button type="button" data-id="{{ $order->id }}" class="btn btn-sm btn-soft-info edits">Edit</button>
              <!-- <button class="btn btn-primary edit-btn" >Edit</button>         -->
              <!-- <button type="button" class="btn btn-sm btn-soft-info">Edit</button> -->
            </td>
    </div>
    </tr> @endforeach <tr>
      <td colspan="10">{{ $orders->links() }}</td>
    </tr> @else <tr>
      <td>Records Not Found</td>
    </tr> @endif </tbody>
    </table>
  </div>
</div> @endsection
@section('scripts')
<script>
  $(document).ready(function() {
    $(".update-status-btn").click(function() {
      var id = $(this).data("id");
      $.ajax({
        type: 'POST',
        url: "{{ url('/accept-booking') }}",
        data: {
          id: id,
          _token: "{{ csrf_token() }}"
        },
        success: function(response) {
          var st = response.success;
          if (st == "true") {
            $(".sucmsg").append(" <p> Order has been accepted successfully. </p>");
            setTimeout(function() {
              history.go(0);
            }, 1200);
          } else {
            return false;
          }
        }
      });
    });

    $(".cancl-status-btn").click(function() {
      var id = $(this).data("id");
      $.ajax({
        type: 'POST',
        url: "{{ url('/cancel-booking') }}",
        data: {
          id: id,
          _token: "{{ csrf_token() }}"
        },
        success: function(response) {
          var st = response.success;
          if (st == "true") {
            $(".sucmsg").append(" <p> Order has been canceled successfully. </p>");
            setTimeout(function() {
              history.go(0);
            }, 1200);
          } else {
            return false;
          }
        }
      });
    });
 
    $(document).on("click", ".views", function() {
      var id = $(this).data("id");
      $(".bd-example-modal-lgview .modal-content .modal-body .reservation-details").empty();
      $.ajax({
        type: 'GET',
        url: "{{ url('/reservation') }}/" + id,
        success: function(response) {
          var st = response.success;
          var ort = response.od;
          if (st == "true") {
            // Create a new unordered list element
            var ul = $('<ul></ul>');

            // Create list items and append them to the unordered list
            ul.append('<li>Name: ' + ort['firstname'] + '</li>');
            if (ort['lastname'] != null)
              ul.append('<li>Last Name: ' + ort['lastname'] + '</li>');
            if (ort['occasion'] != null)
              ul.append('<li>Occasion: ' + ort['occasion'] + '</li>');
            if (ort['date'] != null)
              ul.append('<li>Date: ' + ort['date'] + '</li>');
            if (ort['time'] != null)
              ul.append('<li>Time: ' + ort['time'] + '</li>');
            if (ort['email'] != null)
              ul.append('<li>Email: ' + ort['email'] + '</li>');
            if (ort['phone'] != null)
              ul.append('<li>Phone: ' + ort['phone'] + '</li>');
            if (ort['person'] != null)
              ul.append('<li>Person: ' + ort['person'] + '</li>');
            if (ort['promocode'] != null)
              ul.append('<li>Promo Code: ' + ort['promocode'] + '</li>');
            if (ort['status'] != null)
              ul.append('<li>Status: ' + ort['status'] + '</li>');
            if (ort['comments'] != null)
              ul.append('<li>Comments: ' + ort['comments'] + '</li>');
            if (ort['source'] != null)
              ul.append('<li>Source: ' + ort['source'] + '</li>');

            // Append the unordered list to the modal body
            $(".bd-example-modal-lgview .modal-content .modal-body .reservation-details").append(ul);

            // Show the modal
            $(".bd-example-modal-lgview").modal("show");

          } else {
            return false;
          }
        }
      });
    });

    $(".edits").click(function() {
      var id = $(this).data("id");
      $(".bd-example-modal-lgedit .modal-content .modal-body form .row").empty();
      $.ajax({
        type: 'GET',
        url: "{{ url('/record') }}/" + id,
        success: function(response) {
          var st = response.success;
          var ort = response.od;
          if (st == "true") {
            $(".bd-example-modal-lgedit").modal("show");
            $(".bd-example-modal-lgedit .modal-content .modal-body form .row").append('<div class="form-group mb-4 col-4"><label for= "defaultInput"> Number of Guest </label><select class="form-control" name="person"><option value= "' + ort['person'] + '" selected> ' + ort['person'] + 'Peoples </option><option value="2"> 2 People </option><option value="3"> 3 People </option><option value="4"> 4 People </option><option value = "5"> 5 People </option><option value="6"> 6 People </option><option value="7">7 People </option><option value="8">8 People </option><option value="9"> 9 People </option>< option value="10"> 10 People</option></select></div><div class ="form-group mb-4 col-4"><label>Date</label><input type="date" class="form-control" id="password_confirmation" name="date" value="' + ort['date'] + '" required></div> <div class="form-group mb-4 col-4"><label for="defaultInput">Time</label><input type="time" value="' + ort['time'] + '"class= "form-control" id="" name="time" required></div><div class="form-group mb-4 col-6"><label for="defaultInput"> First Name </label> <input type="text" class="form-control" id="firstname" name="firstname" value="' + ort['firstname'] + '" required> </div><div class="form-group mb-4 col-6"><label for="defaultInput"> Last Name </label> <input type="text" class="form-control" id="" name="lastname" value="' + ort['lastname'] + '"> </div><div class="form-group mb-4 col-6"> <label for="defaultInput"> Phone Number </label> <input type="text" class ="form-control" id="" name="phone" value=" ' + ort['phone'] + ' "></div><div class="form-group mb-4 col-6"><label for="defaultInput"> Email Address </label> <input type="email" class= "form-control" id="email" name="email" value="' + ort['email'] + '" required> </div> <div class="form-group mb-4 col-6"><label for="defaultInput"> Select An Occasion </label> <select class="form-control" name ="occasion"><option value="' + ort['occasion'] + '" selected> ' + ort['occasion'] + ' </option> <option value="Birthday Party"> Birthday Party </option><option value="Anniversary Party"> Anniversary Party </option> <option value="Other"> Other </option> </select> </div> <div class="form-group mb-4 col-6"> <input type="hidden"class="form-control" value="no" name="promocode" /><input type="hidden" class="form-control" value="' + ort['id'] + '" name="id" required/></div><div class="form-group mb-4 col-12"> <label for="defaultInput"> Add A Special Request </label><textarea class="form-control" id="" name="comment" > ' + ort['comments'] + ' </textarea> </div>');
          } else {
            return false;
          }
        }
      });
    });


    $("#editForm").submit(function(event) {
      event.preventDefault();
      var formData = $(this).serialize();
      $.ajax({
        type: 'POST',
        url: "{{ url('/update-record/') }}",
        data: formData,
        success: function(response) {
          if (response.success == "true") {
            $(".bd-example-modal-lgedit .modal-body .alert-sucess1").show();
            $(".bd-example-modal-lgedit .modal-body .alert-sucess1").append(response.msg);
            setTimeout(function() {
              $(".bd-example-modal-lgedit").modal("hide");
              $(".bd-example-modal-lgedit .modal-body .alert-sucess1").hide();
              history.go(0);
            }, 5000);
          } else {
            return false;
          }
        },
        error: function(xhr, status, error) {
          // Handle the error
        }
      });
    });



    $("form#bookorderh").submit(function(event) {
      const selectedOption = $('input[name="eventType"]:checked').val();
      //console.log(selectedOption);
      if (selectedOption == 'newReservation') {
        event.preventDefault();
        var form_data = $("#bookorderh").serialize();
        $.ajax({
          type: "POST",
          url: "{{ url('book-order') }}",
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
      } else if (selectedOption == 'otherEvents') {
        event.preventDefault();
        alert('You can add Other Events from dashboard');
        $('#adr').modal('hide');
      } else {
        alert("Please fill all the fields.");
      }
    });
  });

  $(function() {
    $('#eventTypeSelect').hide();
    $('#newReservation').prop('checked', true);
    $('#defaultInputdate').removeAttr('readonly');
    $('.comment').hide();
    $('.promocode').show();
    var dtToday = new Date();
    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    if (month < 10) month = '0' + month.toString();
    if (day < 10) day = '0' + day.toString();
    var maxDate = year + '-' + month + '-' + day;
    // or instead:
    // var maxDate = dtToday.toISOString().substr(0, 10);
    // alert(maxDate);
    $('#defaultInputdate').attr('min', maxDate);
  });

  function resetAndReload() {
    document.getElementById('myfm').reset();

    window.location.href = "{{ route('reservation-list')}}";
  }
</script>

{{-- send message for status: Accept/Reject --}}
<script>
  $(document).ready(function() {
      $(".update-status-btn, .cancl-status-btn").click(function() {
          var id = $(this).data("id");
          var action = $(this).data("action");
          // var message = action === "accept" ? "TWILIO_CONTENT_SID_ACCEPT" : "TWILIO_CONTENT_SID_REJECT";
          var message = action === "accept" ? "HX839850749b368b0e15a58d4b04de09f2" : "HXd59bb0d55e7ec48c86f93f57bdaca898";
          var countryCode = $(this).data("country-code");
          var phone = $(this).data("phone");
          var recipient = countryCode + phone;

          $.ajax({
              type: 'POST',
              url: "{{ route('send.whatsapp') }}",
              data: {
                  recipient: recipient, 
                  message: message,
                  _token: "{{ csrf_token() }}"
              },              
          });
      });
  });
</script>

@endsection