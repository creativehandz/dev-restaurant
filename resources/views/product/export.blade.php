@extends('layouts.backend')

@section('content')

<!-- Start Breadcrumb -->
<div class="mb-4">
    <nav aria-label="breadcrumb">
        <h1 class="h3 text-white">Bulk Export</h1>
        <ol class="breadcrumb bg-transparent small p-0">
            <li class="breadcrumb-item "><a href="./index.html" class="path-color">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Bulk Export</li>
        </ol>
    </nav>
</div>
<!-- End Breadcrumb -->
<div class="card mb-4">
  <header class="card-header">
    <div class="row">

    </div>
  </header>   

  <div class="container my-4">
  <div class="row justify-content-center">
    <!-- Box 1 -->
    <div class="col-6 col-md-4 text-center p-4 bg-light text-dark m-2">
      <h5 class="text-uppercase mb-2 text-black">Step 1</h5>
      <p class="mb-0">Select Data Type</p>
    </div>
    <!-- Box 2 -->
    <div class="col-6 col-md-4 text-center p-4 bg-light text-dark m-2">
      <h5 class="text-uppercase mb-2">Step 2</h5>
      <p class="mb-0">Select Data Range and Export</p>
    </div>
  </div>
</div>
  <div class="card-body">
    <label for="branch" class="form-label">Type</label>
    <select id="branch" class="form-control custom-input-btn w-50">
      <option value="">All Data</option>
      <option value="all-data">All Data</option>
      <option value="date-wise">Date Wise</option>
    </select>
    <div class="d-flex justify-content-end mt-4">
      <button type="reset" class="btn btn-light text-dark custom-btn text-light hover:text-dark">Clear</button>
      <button type="submit" class="ml-3 btn btn-warning custom-border">Export</button>
  </div>
  </div>
</div>
@endsection