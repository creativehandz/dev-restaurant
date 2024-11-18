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

<!-- Add Category Form -->
<div class="card mb-4">
  <div class="card-header">
    <h2 class="h3">English (EN)</h2>
  </div>
  <div class="card-body">
    <div class="mb-3">
      <label for="branch" class="form-label">Parent Branch *</label>
      <select id="branch" class="form-control custom-input-btn">
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
      </select>
    </div>

    <div class="mb-3">
      <label for="categoryName" class="form-label">Name</label>
      <input type="text" id="categoryName" class="form-control custom-input-btn" placeholder="Enter category name">
    </div>

    <div class="container mt-4">
  <div class="row align-items-center">
    <!-- Category Image Section -->
    <div class="col-md-6 d-flex align-items-center">
      <img src="https://admin.road2xtechnology.com/public/assets/admin/img/400x400/img2.jpg" width="80px" alt="" class="me-3">
      <div class="form-group">
      <div class="d-flex align-items-center">
  <label for="fileUpload2" class="me-2">Category Image</label>
  <h4 class="mb-0 text-orange">* ratio (1:1)</h4>
</div>
        <div class="input-group">
          <div class="custom-file">
            <input type="file" class="custom-file-input" id="fileUpload1">
            <label class="custom-file-label" for="fileUpload1">Choose file</label>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Banner Image Section -->
    <div class="col-md-6 d-flex align-items-center">
      <img src="https://admin.road2xtechnology.com/public/assets/admin/img/900x400/img1.jpg" width="160px" alt="" class="me-3">
      <div class="form-group">
      <div class="d-flex align-items-center">
  <label for="fileUpload2" class="me-2">Banner Image</label>
  <h4 class="mb-0 text-orange">* ratio (8:1)</h4>
</div>
        <div class="input-group">
          <div class="custom-file">
            <input type="file" class="custom-file-input" id="fileUpload2">
            <label class="custom-file-label" for="fileUpload2">Choose file</label>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


    <div class="d-flex">
      <button type="button" class="btn custom-btn me-2">Reset</button>
      <button type="button" class="btn-success custom-btn">Submit</button>
    </div>
  </div>
</div>

<!-- Category Table -->
<div class="card mb-4">
  <div class="card-header d-flex justify-content-between">
    <h2 class="h3">Category Table</h2>
    <div class="d-flex">
      <input type="search" class="form-control custom-input-btn me-2" placeholder="Search here">
      <button type="button" class="btn custom-btn">Search</button>
    </div>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th>S.No.</th>
            <th>Category Image</th>
            <th>Name</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td><img src="https://admin.road2xtechnology.com/storage/app/public/product/2023-07-14-64b0f390eddce.png" 
         width="30" 
         height="30" 
         class="rounded-circle" 
         alt="Product Image"></td>
            <td>Main</td>
            <td>Active</td>
            <td>
              <button type="button" class="btn btn-sm btn-soft-info">Edit</button>
              <button type="button" class="btn btn-sm btn-soft-info">Delete</button>
            </td>
          </tr>

          <tr>
            <td>2</td>
            <td><img src="https://admin.road2xtechnology.com/storage/app/public/product/2023-07-14-64b0f390eddce.png" 
         width="30" 
         height="30" 
         class="rounded-circle" 
         alt="Product Image"></td>
            <td>Popular</td>
            <td>Active</td>
            <td>
              <button type="button" class="btn btn-sm btn-soft-info">Edit</button>
              <button type="button" class="btn btn-sm btn-soft-info">Delete</button>
            </td>
          </tr>

          <tr>
            <td>3</td>
            <td><img src="https://admin.road2xtechnology.com/storage/app/public/product/2023-07-14-64b0f390eddce.png" 
         width="30" 
         height="30" 
         class="rounded-circle" 
         alt="Product Image"></td>
            <td>Combos</td>
            <td>Active</td>
            <td>
              <button type="button" class="btn btn-sm btn-soft-info">Edit</button>
              <button type="button" class="btn btn-sm btn-soft-info">Delete</button>
            </td>
          </tr>

          <tr>
            <td>4</td>
            <td><img src="https://admin.road2xtechnology.com/storage/app/public/product/2023-07-14-64b0f390eddce.png" 
         width="30" 
         height="30" 
         class="rounded-circle" 
         alt="Product Image"></td>
            <td>Beverages</td>
            <td>Active</td>
            <td>
              <button type="button" class="btn btn-sm btn-soft-info">Edit</button>
              <button type="button" class="btn btn-sm btn-soft-info">Delete</button>
            </td>
          </tr>

          <tr>
            <td>5</td>
            <td><img src="https://admin.road2xtechnology.com/storage/app/public/product/2023-07-14-64b0f390eddce.png" 
         width="30" 
         height="30" 
         class="rounded-circle" 
         alt="Product Image"></td>
            <td>Salad</td>
            <td>Active</td>
            <td>
              <button type="button" class="btn btn-sm btn-soft-info">Edit</button>
              <button type="button" class="btn btn-sm btn-soft-info">Delete</button>
            </td>
          </tr>

          <tr>
            <td>6</td>
            <td><img src="https://admin.road2xtechnology.com/storage/app/public/product/2023-07-14-64b0f390eddce.png" 
         width="30" 
         height="30" 
         class="rounded-circle" 
         alt="Product Image"></td>
            <td>Wings</td>
            <td>Active</td>
            <td>
              <button type="button" class="btn btn-sm btn-soft-info">Edit</button>
              <button type="button" class="btn btn-sm btn-soft-info">Delete</button>
            </td>
          </tr>

          <tr>
            <td>7</td>
            <td><img src="https://admin.road2xtechnology.com/storage/app/public/product/2023-07-14-64b0f390eddce.png" 
         width="30" 
         height="30" 
         class="rounded-circle" 
         alt="Product Image"></td>
            <td>Wrap</td>
            <td>Active</td>
            <td>
              <button type="button" class="btn btn-sm btn-soft-info">Edit</button>
              <button type="button" class="btn btn-sm btn-soft-info">Delete</button>
            </td>
          </tr>
          <!-- Add more rows as needed -->
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



<!-- Custom CSS -->
<style>
  .custom-input-btn {
    border-radius: 5px;
  }

  .custom-btn {
    background-color: #f8f9fa;
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 10px 20px;
    transition: all 0.3s ease;
  }

  .custom-btn:hover {
    background-color: #007bff;
    color: #fff;
  }

</style>

@endsection