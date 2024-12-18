@extends('layouts.backend')

@section('content')

<!-- Start Breadcrumb -->
<div class="mb-4">
    <nav aria-label="breadcrumb">
        <h1 class="h3 text-white">Product Review</h1>
        <ol class="breadcrumb bg-transparent small p-0">
            <li class="breadcrumb-item "><a href="./index.html" class="path-color">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Product Review</li>
        </ol>
    </nav>
</div>
<!-- End Breadcrumb -->
<div class="card mb-4">
<header class="card-header">
    <div class="row">
    <div class="col-12 col-md-5">
      <h2 class="h3 card-header-title">
        Review List 
        <span class="badge bg-secondary ms-2 d-inline">2</span>
      </h2>
      </div>
      <div class="col-12 col-md-7 d-flex flex-column flex-md-row justify-content-end gap-2">
        <input type="search" class="form-control custom-input-btn m-2" placeholder="Search by Product Name">
        <button type="submit" id="getsearch" class="btn btn-light custom-btn text-dark hover:text-dark m-2">Search</button>

      </div>
    </div>
  </header>    
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-hover" id="myTable">
        <thead >
          <tr>
            <th scope="col" class="px-2 py-2">SL</th>
            <th scope="col" class="px-2 py-2">Product Name</th>
            <th scope="col" class="px-2 py-2 d-none d-md-table-cell">Customer Info</th>
            <th scope="col" class="px-2 py-2 d-none d-md-table-cell">Review</th>
            <th scope="col" class="px-2 py-2 d-none d-md-table-cell">Rating</th>
          </tr>
        </thead>
        <tbody>
          <tr class="py-2">
            <td class="px-2 py-2">1.</td>
            <td class="px-2 py-2">
  <div class="d-flex align-items-center gap-3">
    <img src="https://admin.road2xtechnology.com/storage/app/public/product/2023-07-14-64b0f390eddce.png" 
         width="30" 
         height="30" 
         class="rounded-circle" 
         alt="Product Image"
         style="margin-right: 5px">
    <span>Manchurian Gravy 12</span>
  </div>
</td>
            <td class="px-2 py-2 d-none d-md-table-cell">Abel Tesfaye
              <br> +1 (230) 32323</td>
            <td class="px-2 py-2 d-none d-md-table-cell">Amazing taste!</td>
            <td class="px-2 py-2 d-none d-md-table-cell">3⭐️</td>
          </tr>
          <tr class="py-2">
            <td class="px-2 py-2">2.</td>
            <td class="px-2 py-2">
  <div class="d-flex align-items-center gap-3">
    <img src="https://admin.road2xtechnology.com/storage/app/public/product/2023-07-14-64b0f390eddce.png" 
         width="30" 
         height="30" 
         class="rounded-circle" 
         alt="Product Image"
         style="margin-right: 5px">
    <span>Chilly Paneer</span>
  </div>
</td>
            <td class="px-2 py-2 d-none d-md-table-cell">Tesfaye Abel <br>+1 (230) 32323</td>
            <td class="px-2 py-2 d-none d-md-table-cell">Amazing taste!</td>
            <td class="px-2 py-2 d-none d-md-table-cell">4⭐️</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection