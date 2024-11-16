@extends('layouts.backend')

@section('content')

<!-- Start Breadcrumb -->
<div class="mb-4">
    <nav aria-label="breadcrumb">
        <h1 class="h3 text-white">Bulk Import</h1>
        <ol class="breadcrumb bg-transparent small p-0">
            <li class="breadcrumb-item "><a href="./index.html" class="path-color">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Bulk Import</li>
        </ol>
    </nav>
</div>
<!-- End Breadcrumb -->
<div class="container mt-5">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <input type="search" class="form-control w-25" placeholder="Search by product name">
    <button class="btn btn-danger">Search</button>
  </div>

  <table class="table table-bordered table-hover">
    <thead class="text-center">
      <tr>
        <th>SL</th>
        <th>Product Name</th>
        <th>Selling Price</th>
        <th>Total Sale</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <!-- Row 1 -->
      <tr>
        <td>1</td>
        <td><img src="desi_masala_tea.jpg" alt="Desi Masala Tea" class="img-fluid me-2" style="width: 40px; height: 40px;"> Desi Masala Tea</td>
        <td class="text-center">1.49 CA$</td>
        <td class="text-center">0</td>
        <td class="text-center">
          <input type="checkbox" class="form-check-input toggle-switch">
        </td>
        <td class="text-center">
          <button class="btn btn-sm btn-edit btn-custom"><i class="bi bi-pencil"></i></button>
          <button class="btn btn-sm btn-delete btn-custom"><i class="bi bi-trash"></i></button>
        </td>
      </tr>
      <!-- Add similar rows for other products -->
    </tbody>
  </table>
</div>


@endsection