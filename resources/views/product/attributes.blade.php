@extends('layouts.backend')

@section('content')

<!-- Start Breadcrumb -->
<div class="mb-4">
    <nav aria-label="breadcrumb">
        <h1 class="h3 text-white">Add New Attributes</h1>
        <ol class="breadcrumb bg-transparent small p-0">
            <li class="breadcrumb-item "><a href="./index.html" class="path-color">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Attributes</li>
        </ol>
    </nav>
</div>
<!-- End Breadcrumb -->
<div class="card mb-4">
  <header class="card-header">
    <div class="row">
    <div class="col-12 col-md-5">
      <h2 class="h3 card-header-title">
  Attribute Table 
  <span class="badge bg-dark ms-2 d-inline">3</span>
</h2>
      </div>
      <div class="col-12 col-md-7 d-flex justify-content-end align-items-center gap-2">
  <input 
    type="text" 
    id="categoryName" 
    class="form-control custom-input-btn w-auto mr-10" 
    placeholder="Enter sub category name" 
  />
  <a class="btn btn-success custom-btn" style="margin-right: 10px" href="">Search</a>
  <a class="btn btn-primary" href="">+ Add Attribute</a>
</div>
    </div>
  </header>   
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-hover" id="myTable">
        <thead style="background:#333333;">
          <tr>
            <th scope="col" class="px-2 py-2">SL</th>
            <th scope="col" class="px-2 py-2">Name</th>
            <th scope="col" class="px-2 py-2 d-none d-md-table-cell">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr class="py-2">
            <td class="px-2 py-2">1.</td>
            <td class="px-2 py-2">Cheese Burst</td>
            <td>
              <button type="button" class="btn btn-sm btn-soft-info">Edit</button>
              <button type="button" class="btn btn-sm btn-soft-info">Delete</button>
            </td>
          </tr>
          <tr class="py-2">
            <td class="px-2 py-2">2.</td>
            <td class="px-2 py-2">Spicy</td>
            <td>
              <button type="button" class="btn btn-sm btn-soft-info">Edit</button>
              <button type="button" class="btn btn-sm btn-soft-info">Delete</button>
            </td>
          </tr>
          <tr class="py-2">
            <td class="px-2 py-2">3.</td>
            <td class="px-2 py-2">Thin Crust</td>
            <td>
              <button type="button" class="btn btn-sm btn-soft-info">Edit</button>
              <button type="button" class="btn btn-sm btn-soft-info">Delete</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection


