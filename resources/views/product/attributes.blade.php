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
        <h2 class="h3 card-header-title">Attribute Table</h2>
      </div>
      <div class="col-12 col-md-7 text-end d-flex flex-wrap justify-content-end gap-2">
        <input type="text" placeholder="Search by name" class="form-control w-auto" />
        <a class="btn btn-success custom-btn" href="">Search</a> 
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
            <td class="px-2 py-2 d-none d-md-table-cell">
             

  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#45c2e3" width="20px" height="20px">
    <path d="M3 21v-2.586l12.293-12.293 2.586 2.586L5.586 21H3zM21.707 5.293l-2-2a1 1 0 00-1.414 0l-1.293 1.293 2.586 2.586L21.707 6.707a1 1 0 000-1.414z"/>
  </svg>
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#f04747" width="20px" height="20px">
    <path d="M5 5h14v2H5V5zm2 4h2v10H7V9zm4 0h2v10h-2V9zm4 0h2v10h-2V9zm-5-4h4v-1h-4v1zM9 4h6v1H9V4z"/>
  </svg>

            </td>
          </tr>
          <tr class="py-2">
            <td class="px-2 py-2">2.</td>
            <td class="px-2 py-2">Chilly Momos Gravy</td>
            <td class="px-2 py-2 d-none d-md-table-cell">

          
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#45c2e3" width="20px" height="20px">
    <path d="M3 21v-2.586l12.293-12.293 2.586 2.586L5.586 21H3zM21.707 5.293l-2-2a1 1 0 00-1.414 0l-1.293 1.293 2.586 2.586L21.707 6.707a1 1 0 000-1.414z"/>
  </svg>
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#f04747" width="20px" height="20px">
    <path d="M5 5h14v2H5V5zm2 4h2v10H7V9zm4 0h2v10h-2V9zm4 0h2v10h-2V9zm-5-4h4v-1h-4v1zM9 4h6v1H9V4z"/>
  </svg>

            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection


