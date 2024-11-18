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
  <div class="card-body">
  <label for="branch" class="form-label">Type</label>
      <select id="branch" class="form-control custom-input-btn">
        <option value="">All Data</option>
        <option value="all-data">All Data</option>
        <option value="date-wise">Date Wise</option>
      </select>



          <div class="form-group mb-3 mr-3 ">
            <button type="button" class="btn btn-light custom-btn text-dark hover:text-dark">Clear</button>
            <button type="button" class="btn btn-light custom-btn text-dark hover:text-dark">Export</button>
          </div>
  </div>
</div>
@endsection