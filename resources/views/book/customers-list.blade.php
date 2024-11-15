@extends('layouts.backend')

@section('content')
<!-- Start Breadcrumb -->
<div class="mb-4">
  <nav aria-label="breadcrumb">
    <h1 class="h3 text-white">Customers</h1>
    <ol class="breadcrumb bg-transparent small p-0">
      <li class="breadcrumb-item">
        <a href="./index.html" class="path-color">Home</a>
      </li>
      <li class="breadcrumb-item active" aria-current="page">Customers</li>
    </ol>
  </nav>
</div>
<!-- End Breadcrumb -->

<div class="card mb-4">
  <header class="card-header">
    <div class="row">
      <div class="col-7">
        <h2 class="h3 card-header-title">Customers list</h2>
      </div>
      <div class="col-5 text-end" style="text-align:right;">
        <a id="sendEmailBtn" class="btn btn-success custom-btn" href="#">Send Email</a>
      </div>
    </div>
  </header>
 
  <div class="card-body">
    <div class="table-responsive">
      <form id="customerForm">
        <table class="table table-hover">
          <thead style="background:#333333;">
            <tr>
              <th class="px-4 py-3">Select</th>
              <th class="px-4 py-3">S.No</th>
              <th class="px-4 py-3">First name</th>
              <th class="px-4 py-3">Email</th>
              <th class="px-4 py-3">Phone</th>
            </tr>
          </thead>
          <tbody>
            @foreach($ordr as $key => $odr)
            <tr>
              <td class="px-4 py-3"><input type="checkbox" name="emails[]" class="customer-checkbox" value="{{ $odr->email }}"></td>
              <td class="px-4 py-3">{{ $key+1 }}</td>
              <td class="px-4 py-3">{{ $odr->firstname }}</td>
              <td class="px-4 py-3">{{ $odr->email }}</td>
              <td class="px-4 py-3">{{ $odr->phone }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </form>
    </div>
    <p>{{ $ordr->links() }}</p>
  </div>
</div>

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
