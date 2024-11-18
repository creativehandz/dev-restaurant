@extends('layouts.backend')

@section('content')

<!-- Custom CSS -->
<style>
  .breadcrumb {
    background: transparent;
  }

  .breadcrumb-item a.path-color {
    color: #007bff;
    text-decoration: none;
  }

  .breadcrumb-item.active {
    color: #6c757d;
  }

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

  .table thead {
    background-color: #333;
    color: #fff;
  }

  .table tbody tr:hover {
    background-color: #f1f1f1;
  }
</style>

<!-- Start Breadcrumb -->
<div class="mb-4">
  <nav aria-label="breadcrumb">
    <h1 class="text-white h3">Add a New Sub Category</h1>
    <ol class="p-0 breadcrumb small">
      <li class="breadcrumb-item">
        <a href="./index.html" class="path-color">Home</a>
      </li>
      <li class="breadcrumb-item active" aria-current="page">SubCategory</li>
    </ol>
  </nav>
</div>
<!-- End Breadcrumb -->

<!-- Add Sub Category Form -->
<div class="mb-4 card">
  <div class="card-header">
    <h2 class="h3">English (EN)</h2>
  </div>
  <div class="card-body">
  <div class="container">
  <div class="row">
    <!-- Parent Branch -->
    <div class="mb-3 col-md-6">
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

    <!-- Main Category -->
    <div class="mb-3 col-md-6">
      <label for="mainCategory" class="form-label">Main Category *</label>
      <select id="mainCategory" class="form-control custom-input-btn">
        <option value="">Select a Category</option>
        <option value="beef">Beef</option>
        <option value="chinese">Chinese</option>
        <!-- Add more options -->
      </select>
    </div>
  </div>

  <!-- Sub Category Name -->
  <div class="row">
    <div class="mb-3 col-md-6">
      <label for="subCategoryName" class="form-label">Sub Category Name (EN)</label>
      <input type="text" id="subCategoryName" class="form-control custom-input-btn" placeholder="New Sub Category">
    </div>
  </div>

      <!-- Buttons -->
      <div class="d-flex">
      <button type="button" class="btn btn-danger me-2" style="margin-right: 10px">Reset</button>
      <button type="button" class="btn btn-primary">Submit</button>
    </div>
</div>


  </div>
</div>

<!-- Sub Category Table -->
<div class="mb-4 card">
  <div class="card-header d-flex justify-content-between">
    <h2 class="h3">Sub-Category Table</h2>
    <div class="d-flex">
      <input type="search" class="form-control custom-input-btn me-2" placeholder="Search by sub category name">
      <button type="button" class="btn btn-primary">Search</button>
    </div>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>S.No.</th>
            <th>Main Category</th>
            <th>Sub Category</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td><img src="{{ asset('img/sample.png') }}" alt="Category" width="50"></td>
            <td>Sub Category Name</td>
            <td>Active</td>
            <td>
              <button type="button" class="btn btn-sm btn-soft-info">Edit</button>
              <button type="button" class="btn btn-sm btn-soft-info">Delete</button>
            </td>
          </tr>
          <!-- Add more rows as needed -->
        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection