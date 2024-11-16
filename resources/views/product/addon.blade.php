@extends('layouts.backend')

@section('content')

<!-- Start Breadcrumb -->
<div class="mb-4">
    <nav aria-label="breadcrumb">
        <h1 class="h3 text-white">Add New Table</h1>
        <ol class="breadcrumb bg-transparent small p-0">
            <li class="breadcrumb-item "><a href="./index.html" class="path-color">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add New Table</li>
        </ol>
    </nav>
</div>
<!-- End Breadcrumb -->
<div class="card mb-4">
  <header class="card-header">
    <div class="row">
      <div class="col-5">
        <h2 class="h3 card-header-title">Addon Table</h2>
      </div>
      <div class="col-7 text-end" style="text-align:right;">
        <input type="text" placeholder="Search by product name" class="input input-bordered w-full max-w-xs" />
        <a class="btn btn-success custom-btn" data-toggle="" href="">Search</a>
      </div>
    </div>
</header>   
<div class="card-body">
<div class="table-responsive">
      <table class="table table-hover" id="myTable">
        <thead style="background:#333333;">
          <tr>
            <th scope="col" class="px-4 py-3">SL</th>
            <th scope="col" class="px-4 py-3">Name</th>
            <th scope="col" class="px-4 py-3">Price</th>
            <th scope="col" class="px-4 py-3">Tax (%)</th>
            <th scope="col" class="px-4 py-3">Action</th>
          </tr>
        </thead>
        <tbody>
            <tr>
                <td class="px-4 py-3" >1.</td>
                <td class="px-4 py-3" >
                    <div class=" w-4 h-4 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                        <svg class="absolute w-4 h-4 text-gray-400 -left-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                    </div>
                Manchurian Gravy</td>
                <td class="px-4 py-3" >Abel Tesfaye +1 (230) 32323</td>
                <td class="px-4 py-3" >amazing taste!</td>
                <td class="px-4 py-3" >3⭐️</td>
            </tr>
            <tr>
                <td class="px-4 py-3" >2.</td>
                <td class="px-4 py-3" >Chilly momos Gravy</td>
                <td class="px-4 py-3" >Tesfaye Abel +1 (230) 32323</td>
                <td class="px-4 py-3" >amazing taste!</td>
                <td class="px-4 py-3" >4⭐️</td>
            </tr>
        </tbody>
</table>
</div>
</div>


</div>


@endsection