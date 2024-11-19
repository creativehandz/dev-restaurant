@extends('layouts.backend')

@section('content')

<!-- Start Breadcrumb -->
<div class="mb-4">
    <nav aria-label="breadcrumb">
        <h1 class="h3 text-white">Add New Addon</h1>
        <ol class="breadcrumb bg-transparent small p-0">
            <li class="breadcrumb-item "><a href="./index.html" class="path-color">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Addon</li>
        </ol>
    </nav>
</div>
<!-- End Breadcrumb -->
<div class="card mb-4">
<header class="card-header">
    <div class="row">
    <div class="col-12 col-md-5">
      <h2 class="h3 card-header-title">
        Addon Table 
        <span class="badge bg-secondary ms-2 d-inline">5</span>
      </h2>
      </div>
      <div class="col-12 col-md-7 d-flex flex-column flex-md-row justify-content-end gap-2">
        <input type="search" class="form-control custom-input-btn mr-2" placeholder="Search by Addon Name">
        <button type="submit" id="getsearch" class="btn btn-light custom-btn text-dark hover:text-dark mr-2">Search</button>
        <button type="submit" id="getsearch" class="btn btn-success custom-btn  hover:text-dark">+ Add Attribute</button>
      </div>
    </div>
  </header>    
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-hover" id="myTable">
        <thead>
          <tr>
            <th scope="col" class="px-2 py-2">SL</th>
            <th scope="col" class="px-2 py-2">Name</th>
            <th scope="col" class="px-2 py-2 d-none d-md-table-cell">Price</th>
            <th scope="col" class="px-2 py-2 d-none d-md-table-cell">Tax (%)</th>
            <th scope="col" class="px-2 py-2 d-none d-md-table-cell">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr class="py-2">
            <td class="px-2 py-2">1.</td>
            <td class="px-2 py-2">

              spicy
            </td>
            <td class="px-2 py-2 d-none d-md-table-cell">0.00CA$</td>
            <td class="px-2 py-2 d-none d-md-table-cell">0</td>
            <td class="px-2 py-2 d-none d-md-table-cell">              <button type="button" class="btn btn-sm btn-soft-info">Edit</button>
            <button type="button" class="btn btn-sm btn-soft-info">Delete</button></td>
          </tr>
          <tr class="py-2">
            <td class="px-2 py-2">2.</td>
            <td class="px-2 py-2">Garlic Base</td>
            <td class="px-2 py-2 d-none d-md-table-cell">2.00CA$</td>
            <td class="px-2 py-2 d-none d-md-table-cell">0</td>
            <td class="px-2 py-2 d-none d-md-table-cell">              <button type="button" class="btn btn-sm btn-soft-info">Edit</button>
            <button type="button" class="btn btn-sm btn-soft-info">Delete</button></td>
          </tr>
          <tr class="py-2">
            <td class="px-2 py-2">3.</td>
            <td class="px-2 py-2">Pineapple</td>
            <td class="px-2 py-2 d-none d-md-table-cell">2.00CA$</td>
            <td class="px-2 py-2 d-none d-md-table-cell">0</td>
            <td class="px-2 py-2 d-none d-md-table-cell">              <button type="button" class="btn btn-sm btn-soft-info">Edit</button>
            <button type="button" class="btn btn-sm btn-soft-info">Delete</button></td>
          </tr>
                    <tr class="py-2">
            <td class="px-2 py-2">4.</td>
            <td class="px-2 py-2">Jalepino</td>
            <td class="px-2 py-2 d-none d-md-table-cell">2.00CA$</td>
            <td class="px-2 py-2 d-none d-md-table-cell">0</td>
            <td class="px-2 py-2 d-none d-md-table-cell">              <button type="button" class="btn btn-sm btn-soft-info">Edit</button>
            <button type="button" class="btn btn-sm btn-soft-info">Delete</button></td>
          </tr>
          <tr class="py-2">
            <td class="px-2 py-2">5.</td>
            <td class="px-2 py-2">Tomatos</td>
            <td class="px-2 py-2 d-none d-md-table-cell">2.00CA$</td>
            <td class="px-2 py-2 d-none d-md-table-cell">0</td>
            <td class="px-2 py-2 d-none d-md-table-cell">              <button type="button" class="btn btn-sm btn-soft-info">Edit</button>
            <button type="button" class="btn btn-sm btn-soft-info">Delete</button>  </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>


@endsection