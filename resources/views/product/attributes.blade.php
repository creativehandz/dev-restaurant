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
      <div class="col-5">
        <h2 class="h3 card-header-title">Attribute Table</h2>
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
            <th scope="col" class="px-4 py-3">Action</th>
          </tr>
        </thead>
        <tbody>
            <tr>
                <td class="px-4 py-3" >1.</td>
                <td class="px-4 py-3" >Manchurian Gravy</td>
                <td class="px-4 py-3" >3⭐️</td>
            </tr>
            <tr>
                <td class="px-4 py-3" >2.</td>
                <td class="px-4 py-3" >Chilly momos Gravy</td>
                <td class="px-4 py-3" >4⭐️</td>
            </tr>
        </tbody>
</table>
</div>
</div>


</div>


@endsection