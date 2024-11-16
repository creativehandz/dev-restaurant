@extends('layouts.backend')

@section('content')

<!-- Start Breadcrumb -->
<div class="mb-4">
    <nav aria-label="breadcrumb">
        <h1 class="h3 text-white">Add a New Category</h1>
        <ol class="breadcrumb bg-transparent small p-0">
            <li class="breadcrumb-item "><a href="./index.html" class="path-color">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Category</li>
        </ol>
    </nav>
</div>
<!-- End Breadcrumb -->
<div class="card mb-4">
  <div class="row">
      <!--  -->
      <div class="col-sm-12">
            <div class="card">
            <header class="card-header">
                <div class="row">
                    <div class="col-7 col-md-9">
                        <h2 class="h3 card-header-title">English (EN)</h2>
                    </div> 
                </div>
            </header> 
            <div class="card-body">

            <h3 class="text-white" >Parent Branch *</h3>
            <div class="row mt-2 ml-1 mr-1">
            <select class="form-control custom-input-btn border border-gray-300 rounded-md p-2 w-full">
                <option value="">Select Branch</option>
                <option value="kuala-lumpur">Kuala Lumpur</option>
                <option value="selangor">Selangor</option>
                <option value="johor">Johor Bahru</option>
                <option value="penang">George Town, Penang</option>
                <option value="malacca">Malacca City</option>
                <option value="kedah">Alor Setar, Kedah</option>
                <option value="pahang">Kuantan, Pahang</option>
                <option value="sabah">Kota Kinabalu, Sabah</option>
                <option value="sarawak">Kuching, Sarawak</option>
                <option value="terengganu">Kuala Terengganu</option>
                <option value="perak">Ipoh, Perak</option>
                <option value="kelantan">Kota Bharu, Kelantan</option>
                <option value="negeri-sembilan">Seremban, Negeri Sembilan</option>
                <option value="perlis">Kangar, Perlis</option>
                <option value="putrajaya">Putrajaya</option>
                <!-- Add more branches as needed -->
            </select>
        </div>
        <div class="row mt-2 ml-1 mr-1">
          <h3 class="text-white mt-10" >Name </ß>
            <input 
              type="search" 
              id="customSearchBox" 
              name="search" 
              placeholder="Search here" 
              autocomplete="on" 
              class="form-control custom-input-btn me-2 mr-2" 
            />
        </div>
          <div class="row mt-2 ml-1 mr-1">
            <img src="https://admin.road2xtechnology.com/public/assets/admin/img/400x400/img2.jpg" alt="">
            <img src="https://admin.road2xtechnology.com/public/assets/admin/img/900x400/img1.jpg" alt="">
          </div>
        </div>
          <!-- Buttons -->
          <!-- Search Box -->
          <div class="form-group d-flex align-items-center mb-3 me-3">
          <button type="button" class="btn btn-light custom-btn text-dark">Reset</button>
          <button type="button" class="btn btn-light custom-btn text-dark">Button</button>
            </div>
                     
      </div>
    </div>
  </div>
</div>


<div class="card mb-4">
  <div class="row">
    <!-- Customers List -->
        <div class="col-sm-12">
            <div class="card">
            <header class="card-header">
                <div class="row">
                    <div class="col-7 col-md-9">
                        <h2 class="h3 card-header-title">Category Table</h2>
                    </div>
                    <div class="col-5 col-md-3 text-end" style="text-align: right;">
                    <!-- Search Box -->
                    <div class="form-group d-flex align-items-center mb-3 me-3">
                      <input 
                        type="search" 
                        id="customSearchBox" 
                        name="search" 
                        placeholder="Search here" 
                        autocomplete="on" 
                        class="form-control custom-input-btn me-2 mr-2" 
                      />
                      <button type="button" class="btn btn-light custom-btn text-dark">Search</button>
                    </div>
                  </div>
                </div>
            </header>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead style="background:#333333;">
                                <tr>
                                    <th class="px-4 py-3">S.No.</th>
                                    <th class="px-4 py-3">Category Image</th>
                                    <th class="px-4 py-3">Name</th>
                                    <th class="px-4 py-3">Status</th>
                                    <th class="px-4 py-3">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                                    <tr class="p-2">
                                        <td class="px-4 py-3"><input type="checkbox" name="emails[]" class="customer-checkbox" value=""></td>
                                        <td class="px-4 py-3">1</td>
                                        <td class="px-4 py-3">irstname</td>
                                        <td class="px-4 py-3">email</td>
                                        <td class="px-4 py-3">phone</td>
                                    </tr>
                               
                            </tbody>
                        </table>
                    </div>
                  
                </div>
            </div>
        </div>
        </div>
  </div>


@endsection