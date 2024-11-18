@extends('layouts.backend')

@section('content')

<!-- Start Breadcrumb -->
<div class="mb-4">
    <nav aria-label="breadcrumb">
        <h1 class="h3 text-white">Add a New Category</h1>
        <ol class="breadcrumb bg-transparent small p-0">
            <li class="breadcrumb-item "><a href="./index.html" class="path-color">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Category</li>
        </ol>
    </nav>
</div>
<!-- End Breadcrumb -->

<!-- Add Category Form -->
<div class="card mb-4">
  <div class="card-header">
    <h2 class="h3">English (EN)</h2>
  </div>
  <div class="card-body">
    <div class="mb-3">
      <label for="branch" class="form-label">Parent Branch *</label>
      <select id="branch" class="form-control custom-input-btn">
        <option value="">Select Branch</option>
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

    <div class="mb-3">
      <label for="categoryName" class="form-label">Name</label>
      <input type="text" id="categoryName" class="form-control custom-input-btn" placeholder="Enter category name">
    </div>

    <div class="d-flex">
      <button type="button" class="btn custom-btn me-2">Reset</button>
      <button type="button" class="btn custom-btn">Submit</button>
    </div>
  </div>
</div>

<!-- Category Table -->
<div class="card mb-4">
  <div class="card-header d-flex justify-content-between">
    <h2 class="h3">Category Table</h2>
    <div class="d-flex">
      <input type="search" class="form-control custom-input-btn me-2" placeholder="Search here">
      <button type="button" class="btn custom-btn">Search</button>
    </div>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th>S.No.</th>
            <th>Category Image</th>
            <th>Name</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td><img src="{{ asset('img/sample.png') }}" alt="Category" width="50"></td>
            <td>Category Name</td>
            <td>Active</td>
            <td>
              <button class="btn btn-sm btn-primary">Edit</button>
              <button class="btn btn-sm btn-danger">Delete</button>
            </td>
          </tr>
          <!-- Add more rows as needed -->
        </tbody>
      </table>
    </div>
  </div>
</div>



<!-- Custom CSS -->
<style>
  .custom-input-btn {
    border-radius: 5px;
  }

  .custom-btn {
    background-color: #f8f9fa;
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 10px 20px;
    transition: all 0.3s ease;
  }

  .custom-btn:hover {
    background-color: #007bff;
    color: #fff;
  }

</style>

@endsection