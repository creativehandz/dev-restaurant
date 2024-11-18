@extends('layouts.backend')

@section('content')

<!-- Start Breadcrumb -->
<div class="mb-4">
    <nav aria-label="breadcrumb">
        <h1 class="h3 text-white">Attributes</h1>
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
  <span class="badge bg-dark ms-2 d-inline">2</span>
</h2>
      </div><div class="col-12 col-md-7 text-end d-flex flex-wrap justify-content-end">
  <input type="text" placeholder="Search by name" class="form-control w-auto" style="margin-right: 10px;" />
  <a class="btn btn-success custom-btn" href="" style="margin-right: 10px;">Search</a>
  <a class="btn btn-success custom-btn" href="">+ Add Attribute</a>
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
            <td class="px-2 py-2">Manchurian Gravy</td>
            <td>
              <button type="button" class="btn btn-sm btn-soft-info">Edit</button>
              <button type="button" class="btn btn-sm btn-soft-info">Delete</button>
            </td>
          </tr>
          <tr class="py-2">
            <td class="px-2 py-2">2.</td>
            <td class="px-2 py-2">Chilly Momos Gravy</td>
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


