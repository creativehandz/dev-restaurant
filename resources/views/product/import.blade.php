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
<div class="card mb-4"> 
  <div class="card-body">
        <div class="flex flex-col text-white justify-center" >
        <h1>Instructions</h1>
        <ol>
            <li>Download the format file and fill it with proper data.</li>
            <li>You can download the example file to understand how the data must be filled</li>
            <li>Once you have downloaded and filled the format file upload it in the form below and submit.</li>
            <li>After uploading products you need to edit them and set product s images and choices.</li>
            <li>You can get category and sub-category id from their list please input the right ids.</li>
        </ol>
        </div>
<!--
          <div class="form-group mb-3 mr-3 ">
            <button type="button" class="btn btn-light custom-btn text-dark hover:text-dark">Clear</button>
            <button type="button" class="btn btn-light custom-btn text-dark hover:text-dark">Export</button>
          </div> -->
  </div>
</div>
<div class="card mb-4">
  <div class="card-body">

    <!-- Download Link -->
     <div class="text-center">
    <h1>
      Do not have the template? 
      <a href="#" class="text-blue" style="text-decoration: none;">Download Here</a>
    </h1>
    </div>
    <!-- Drag and Drop File Section -->
    <!-- <h1>Drag the file here or import the file</h1> -->
    <div class="form-group mb-3 mr-3">
      <div class="border p-4 rounded d-flex justify-content-center align-items-center"
           style="border: 2px dashed #ccc; background-color: #f9f9f9; height: 150px; position: relative;">
        <input type="file" id="fileUpload" class="position-absolute w-100 h-100 opacity-0">
        <div class="text-center">
          <p>Drag & Drop or Click to Select File</p>
        </div>
      </div>
    </div>

    <!-- Buttons Section -->
    <div class="d-flex justify-content-end mt-4">
    <button type="reset" class="btn btn-light custom-btn text-dark hover:text-dark">Clear</button>
    <button type="submit" class="ml-3 btn btn-warning custom-border">Export</button>
</div>

  </div>
</div>

@endsection