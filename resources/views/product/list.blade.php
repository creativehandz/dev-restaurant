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
          <span class="badge bg-secondary ms-2 d-inline">138</span>
        </h2>
      </div>
    </div>

    <div class="row align-items-center">
  <!-- Search Box and Button on the Left -->
  <div class="col-12 col-md-6 d-flex align-items-center gap-2 mt-4">
    <input 
      type="text" 
      id="categoryName" 
      class="form-control custom-input-btn w-auto mr-2" 
      placeholder="Search by Addon name" 
    />
    <button type="submit" id="getsearch" class="btn btn-light custom-btn text-dark hover:text-dark">Search</button>
  </div>
  
  <!-- Export and Add Button on the Right -->
  <div class="col-12 col-md-6 d-flex justify-content-end gap-2">
    <a class="btn btn-success custom-btn" style="margin-right: 10px" href="">Export</a>
    <a class="btn btn-success  custom-btn text-white" href="">+ Add Addon</a>
  </div>
</div>

    
  </header>   

  <div class="card-body">
   <div class="flex flex-col text-white justify-center" >
    <div class="table-responsive">
      <table class="table table-hover" id="myTable">
        <thead>
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
            <td class="px-2 py-2 d-none d-md-table-cell">1.49CA$</td>
            <td class="px-2 py-2 d-none d-md-table-cell">0</td>
            <td class="px-2 py-2 d-none d-md-table-cell">Active</td>
            <td class="px-2 py-2 d-none d-md-table-cell">
            <button type="button" class="btn btn-sm btn-soft-info">Edit</button>
            <button type="button" class="btn btn-sm btn-soft-info">Delete</button>
            </td>
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
            <td class="px-2 py-2 d-none d-md-table-cell">1.49CA$</td>
            <td class="px-2 py-2 d-none d-md-table-cell">0</td>
            <td class="px-2 py-2 d-none d-md-table-cell">Active</td>
            <td class="px-2 py-2 d-none d-md-table-cell">
            <button type="button" class="btn btn-sm btn-soft-info">Edit</button>
            <button type="button" class="btn btn-sm btn-soft-info">Delete</button>
            </td>
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
            <td class="px-2 py-2 d-none d-md-table-cell">1.49CA$</td>
            <td class="px-2 py-2 d-none d-md-table-cell">0</td>
            <td class="px-2 py-2 d-none d-md-table-cell">Active</td>
            <td class="px-2 py-2 d-none d-md-table-cell">
            <button type="button" class="btn btn-sm btn-soft-info">Edit</button>
            <button type="button" class="btn btn-sm btn-soft-info">Delete</button>
            </td>
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
            <td class="px-2 py-2 d-none d-md-table-cell">1.49CA$</td>
            <td class="px-2 py-2 d-none d-md-table-cell">0</td>
            <td class="px-2 py-2 d-none d-md-table-cell">Active</td>
            <td class="px-2 py-2 d-none d-md-table-cell">
            <button type="button" class="btn btn-sm btn-soft-info">Edit</button>
            <button type="button" class="btn btn-sm btn-soft-info">Delete</button>
            </td>
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
            <td class="px-2 py-2 d-none d-md-table-cell">1.49CA$</td>
            <td class="px-2 py-2 d-none d-md-table-cell">0</td>
            <td class="px-2 py-2 d-none d-md-table-cell">Active</td>
            <td class="px-2 py-2 d-none d-md-table-cell">
            <button type="button" class="btn btn-sm btn-soft-info">Edit</button>
            <button type="button" class="btn btn-sm btn-soft-info">Delete</button>
            </td>
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
            <td class="px-2 py-2 d-none d-md-table-cell">1.49CA$</td>
            <td class="px-2 py-2 d-none d-md-table-cell">0</td>
            <td class="px-2 py-2 d-none d-md-table-cell">Active</td>
            <td class="px-2 py-2 d-none d-md-table-cell">
            <button type="button" class="btn btn-sm btn-soft-info">Edit</button>
            <button type="button" class="btn btn-sm btn-soft-info">Delete</button>
            </td>
          </tr>


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
</div>
@endsection