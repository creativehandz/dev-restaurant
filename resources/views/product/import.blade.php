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
 <div class="mb-4 p-4">
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
        <div class="max-w-lg w-full">
        <h4 class="text-white">type</h4>
            <div class="form-group col-5 col-md-auto mb-3 mr-3">
                <select name="promocode" class="form-control custom-input-btn">
                <option value="" <?php echo isset($search_inputs['promocode']) ? 'selected' : ''; ?>>Promo Code</option>
                <option value="Yes" <?php echo (isset($search_inputs['promocode']) && $search_inputs['promocode'] == 'Yes') ? 'selected' : ''; ?>>Yes</option>
                <option value="No" <?php echo (isset($search_inputs['promocode']) && $search_inputs['promocode'] == 'No') ? 'selected' : ''; ?>>No</option>
                </select>
            </div>
          </div>
          <div class="flex space-x-4">
    <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md">Reset</button>
    <button class="px-4 py-2 bg-orange-500 text-white rounded-md">Submit</button>
  </div>
    </div>
 </div>


@endsection