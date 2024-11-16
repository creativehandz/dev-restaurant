@extends('layouts.backend')

@section('content')

<!-- Start Breadcrumb -->
<div class="mb-4">
    <nav aria-label="breadcrumb">
        <h1 class="h3 text-white">POS Orders</h1>
        <ol class="breadcrumb bg-transparent small p-0">
            <li class="breadcrumb-item "><a href="./index.html" class="path-color">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">POS Orders</li>
        </ol>
    </nav>
</div>
<!-- End Breadcrumb -->


<!-- Table -->
<div class="card mb-4">
  <header class="card-header">
    <div class="row">
      <div class="col-12 mb-3">
        <h2 class="h3 card-header-title">Select Date Range</h2>
      </div>
      <div class="col-13">
        <!-- Custom search input -->
        <form class="form-inline">
          
          <div class="form-group col-5 col-md-auto mb-3 mr-3">
            <select name="branch" class="form-control custom-input-btn">
                <option value="">All Branches</option>
                <option value="kuala-lumpur">Kuala Lumpur</option>
                <option value="selangor">Selangor</option>
                <option value="johor">Johor Bahru</option>
                <option value="penang">George Town, Penang</option>
                <option value="malacca">Malacca City</option>
                <option value="kedah">Alor Setar, Kedah</option>
                <option value="pahang">Kuantan, Pahang</option>
                <option value="sabah">Kota Kinabalu, Sabah</option>
                <option value="sarawak">Kuching, Sarawak</option>
                <option value="terengganu">Kuala Terengganu</option>
                <option value="perak">Ipoh, Perak</option>
                <option value="kelantan">Kota Bharu, Kelantan</option>
                <option value="negeri-sembilan">Seremban, Negeri Sembilan</option>
                <option value="perlis">Kangar, Perlis</option>
                <option value="putrajaya">Putrajaya</option>
            </select>
          </div>
          <div class="form-group col-5 col-md-auto mb-3">
            <label class="mr-1">From</label>
            <input type="date" name="fromdate" class="form-control custom-input-btn">
          </div>
          <div class="form-group col-5 col-md-auto mb-3 mr-3">
            <label class="mr-1 ml-3">To</label>
            <input type="date" name="todate" class="form-control custom-input-btn">
          </div>

          <div class="form-group mb-3 mr-3 ml-3">
            <button type="button" class="btn btn-success custom-border">Show Data</button>
          </div>
         

</form>
</div>

    </div>
  </header>
  <div class="card-body">
    <div class="row">
      <div class="col-13">
        <!-- Custom search input -->
        <form class="form-inline">
          
         
          <div class="form-group col-5 col-md-auto mb-3 mr-3">
            <input type="search" id="customSearchBox" name="search" placeholder="Search by ID  customer or payment status" autocomplete="on" class="form-control custom-input-btn" />
          </div>
          <div class="form-group mb-3 mr-3 ml-3">
            <button type="button" class="btn btn-light custom-btn text-dark hover:text-dark">Search</button>
          </div>
         
          <div class="form-group mb-3 mr-3 ">
            <a href="#" onclick="window.print();return false;" class="btn btn-success custom-border">Export</a>
          </div>
         
        </form>
      </div>
    </div>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-12 col-md-12">
        <div class="sucmsg"></div>
      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-hover" id="myTable">
        <thead style="background:#333333; color: #fff;">
          <tr>
            <th scope="col" class="px-4 py-3">S.No</th>
            <th scope="col" class="px-4 py-3">Order ID</th>
            <th scope="col" class="px-4 py-3">Order Date</th>
            <th scope="col" class="px-4 py-3">Customer Info</th>
            <th scope="col" class="px-4 py-3">Branch</th>
            <th scope="col" class="px-4 py-3">Total Amount</th>
            <th scope="col" class="px-4 py-3">Order Status</th>
            <th scope="col" class="px-4 py-3">Order Type</th>
            <th scope="col" class="px-4 py-3">Action</th>
          </tr>
        </thead>
        <tbody>
          <!-- Static Rows -->
          <tr>
            <td class="px-4 py-3">1</td>
            <td class="px-4 py-3">12010</td>
            <td class="px-4 py-3">Mon 01 Jan<br>10:00 AM</td>
            <td class="px-4 py-3">John Doe</td>
            <td class="px-4 py-3">Kuala Lampur</td>
            <td class="px-4 py-3">$7.99<br>Paid</td>
            <td class="px-4 py-3"><span class="text-success">Delivered</span></td>
            <td class="px-4 py-3"><span class="text-success">Accepted</span></td>
            <td class="px-4 py-3">
              <button type="button" class="btn btn-sm btn-soft-info">Accept</button>
              <button type="button" class="btn btn-sm btn-soft-info">Reject</button>
              <button type="button" class="btn btn-sm btn-soft-info">View</button>
              <button type="button" class="btn btn-sm btn-soft-info">Edit</button>
            </td>
          </tr>
          <tr>
            <td class="px-4 py-3">2</td>
            <td class="px-4 py-3">10909</td>
            <td class="px-4 py-3">Tue 02 Feb<br>11:30 AM</td>
            
            <td class="px-4 py-3">Jane Smith</td>
            <td class="px-4 py-3">Putrajaya</td>
            <td class="px-4 py-3">$10.99<br>Paid</td>
            <td class="px-4 py-3"><span class="text-success">Delivered</span></td>
            <td class="px-4 py-3"><span class="text-warning">Pending</span></td>
            <td class="px-4 py-3">
              <button type="button" class="btn btn-sm btn-soft-info">Accept</button>
              <button type="button" class="btn btn-sm btn-soft-info">Reject</button>
              <button type="button" class="btn btn-sm btn-soft-info">View</button>
              <button type="button" class="btn btn-sm btn-soft-info">Edit</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>



@endsection