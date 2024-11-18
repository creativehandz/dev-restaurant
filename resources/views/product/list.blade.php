@extends('layouts.backend')

@section('content')

<!-- Start Breadcrumb -->
<div class="mb-4">
    <nav aria-label="breadcrumb">
        <h1 class="h3 text-white">Product List</h1>
        <ol class="breadcrumb bg-transparent small p-0">
            <li class="breadcrumb-item "><a href="./index.html" class="path-color">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Product List</li>
        </ol>
    </nav>
</div>
<!-- End Breadcrumb -->
<div class="card mb-4"> 
<header class="card-header">
    <div class="row">
      <div class="col-12 col-md-5">
      <h2 class="h3 card-header-title">
        Product List 
        <span class="badge bg-dark ms-2 d-inline">138</span>
      </h2>
      </div>
      </div>
      <div class="col-12 col-md-7 text-end d-flex flex-wrap justify-content-end">
        <input type="text" placeholder="Search by product name" class="form-control w-auto me-3"/>
        <a class="btn btn-success custom-btn" style="margin-right: 10px"  href="">Search</a>
        <a class="btn btn-success custom-btn" style="margin-right: 10px"  href="">Import</a>
        <a class="btn btn-primary" href="">+ Add New Product</a>
      </div>
    
  </header>   

  <div class="card-body">
   <div class="flex flex-col text-white justify-center" >
    <div class="table-responsive">
      <table class="table table-hover" id="myTable">
        <thead style="background:#333333;">
          <tr>
            <th scope="col" class="px-2 py-2">SL</th>
            <th scope="col" class="px-2 py-2">Product Name</th>
            <th scope="col" class="px-2 py-2 d-none d-md-table-cell">Selling Price</th>
            <th scope="col" class="px-2 py-2 d-none d-md-table-cell">Total Sale</th>
            <th scope="col" class="px-2 py-2 d-none d-md-table-cell">Status</th>
            <th scope="col" class="px-2 py-2 d-none d-md-table-cell">Action</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
      <div class="container mt-4">
  <nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
      <li class="page-item">
        <a class="page-link" href="#" aria-label="Previous">
          <span aria-hidden="true">&laquo;</span>
        </a>
      </li>
      <li class="page-item"><a class="page-link" href="#">1</a></li>
      <li class="page-item"><a class="page-link" href="#">2</a></li>
      <li class="page-item"><a class="page-link" href="#">3</a></li>
      <li class="page-item">
        <a class="page-link" href="#" aria-label="Next">
          <span aria-hidden="true">&raquo;</span>
        </a>
      </li>
    </ul>
  </nav>
     </div>
  </div>
</div>
</div>

@endsection