@extends('layouts.backend')

@section('content')

<!-- Start Breadcrumb -->
<div class="mb-4">
    <nav aria-label="breadcrumb">
        <h1 class="h3 text-white">New Sale</h1>
        <ol class="breadcrumb bg-transparent small p-0">
            <li class="breadcrumb-item "><a href="./index.html" class="path-color">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">New Sale</li>
        </ol>
    </nav>
</div>
<!-- End Breadcrumb -->

<div class="row">
    <!-- Current Projects -->
    <div class="col-md-6 mb-4 mb-md-0">
    <div class="card mb-4">
  <header class="card-header">
    <div class="row">
      <div class="col-5">
        <h2 class="h3 card-header-title">Product Section</h2>
      </div>
    </div>
  </header>

  <div class="card-body">
  <div class="row">
  <div class="col-12">
    <!-- Custom search input -->
    <form class="d-flex flex-wrap align-items-center">
      <!-- Category Dropdown -->
      <div class="form-group col-md-auto mb-3 me-3">
        <select name="food-category" class="form-control custom-input-btn border border-gray-300 rounded-md p-2">
          <option value="">All Categories</option>
          <option value="appetizers">Appetizers</option>
          <option value="main-course">Main Course</option>
          <option value="desserts">Desserts</option>
          <option value="beverages">Beverages</option>
          <option value="fast-food">Fast Food</option>
          <option value="healthy">Healthy Food</option>
          <option value="vegan">Vegan</option>
          <option value="seafood">Seafood</option>
          <option value="soups">Soups</option>
          <option value="salads">Salads</option>
          <option value="grill">Grill</option>
          <option value="snacks">Snacks</option>
        </select>
      </div>

      <!-- Search Box -->
      <div class="form-group col-md-auto mb-3 me-3">
        <input type="search" id="customSearchBox" name="search" placeholder="Search here" autocomplete="on" class="form-control custom-input-btn" />
      </div>

      <!-- Search Button -->
      <div class="form-group col-md-auto mb-3">
        <button type="button" class="btn btn-light custom-btn text-dark">Search</button>
      </div>
    </form>
  </div>
</div>
</div>

<div class="card-body">
<div class="pos-item-wrap row justify-content-center">
  <!-- Product Item 1 -->
  <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
    <div class="pos-product-item card h-100">
      <div class="pos-product-item_thumb">
        <img src="https://admin.road2xtechnology.com/storage/app/public/product/2023-07-14-64b0f390eddce.png"  
             class="img-fit card-img-top">
      </div>
      <div class="pos-product-item_content card-body">
        <div class="pos-product-item_title text-truncate">Veg Mania Pizza...</div>
        <div class="pos-product-item_price">$11.00</div>
      </div>
    </div>
  </div>

  <!-- Product Item 2 -->
  <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
    <div class="pos-product-item card h-100">
      <div class="pos-product-item_thumb">
        <img src="https://admin.road2xtechnology.com/public/assets/admin/img/160x160/img2.jpg" 
             class="img-fit card-img-top">
      </div>
      <div class="pos-product-item_content card-body">
        <div class="pos-product-item_title text-truncate">Cold Coffee</div>
        <div class="pos-product-item_price">$5.93</div>
      </div>
    </div>
  </div>

  <!-- Product Item 3 -->
  <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
    <div class="pos-product-item card h-100">
      <div class="pos-product-item_thumb">
        <img src="https://admin.road2xtechnology.com/public/assets/admin/img/160x160/img2.jpg" 
             class="img-fit card-img-top">
      </div>
      <div class="pos-product-item_content card-body">
        <div class="pos-product-item_title text-truncate">Bun Maska With...</div>
        <div class="pos-product-item_price">$6.92</div>
      </div>
    </div>
  </div>

  <!-- Product Item 4 -->
  <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
    <div class="pos-product-item card h-100">
      <div class="pos-product-item_thumb">
        <img src="https://admin.road2xtechnology.com/storage/app/public/product/2023-07-14-64b0f390eddce.png" 
             class="img-fit card-img-top">
      </div>
      <div class="pos-product-item_content card-body">
        <div class="pos-product-item_title text-truncate">
            Manchurian Grav...</div>
        <div class="pos-product-item_price">$120.00</div>
      </div>
    </div>
  </div>
</div>

</div>

</div>
    </div>

<!-- Billing Section -->
    <div class="col-md-6">
    <div class="card mb-4">
  <header class="card-header">
    <div class="row">
      <div class="col-5">
        <h2 class="h3 card-header-title">Billing Section</h2>
      </div>
    </div>
  </header>

  <div class="card-body">

      <div class="col-13">
        <!-- Custom search input -->
        <form class="form-inline">
        <div class="row">
          <div class="form-group col-4 col-md-auto mb-3 mr-3">
            <select name="customer" class="form-control custom-input-btn border border-gray-300 rounded-md p-2 w-full">
                <option value="">Select Customer</option>
                <option value="john-doe">John Doe</option>
                <option value="jane-smith">Jane Smith</option>
                <option value="michael-johnson">Michael Johnson</option>
                <option value="emily-davis">Emily Davis</option>
                <option value="david-wilson">David Wilson</option>
                <option value="linda-brown">Linda Brown</option>
                <option value="james-jones">James Jones</option>
                <option value="sarah-miller">Sarah Miller</option>
            </select>

          </div>

          <div class="form-group col-4 mb-3 mr-3 ml-3">
            <button type="button" class="btn btn-success custom-border">+ Customer</button>
          </div>
          </div>
        </form>
      </div>

      <div class="row mt-2">
      <div class="col-5">
        <h2 class="h3 card-header-title">Choose Branch</h2>
      </div>
    </div>

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

      <div class="row mt-4 ml-1 mr-1">
      <select class="form-control custom-input-btn border border-gray-300 rounded-md p-2 w-full">
                <option>Select Table</option>
            </select>
      </div>

      <div class="row mt-4 ml-1 mr-1">
      <input type="number" placeholder="Number of People" class="form-control custom-input-btn">
      </div>
    
      <!-- Billing Table -->
    <div class="table-responsive mt-4">
      <table class="table table-hover" id="myTable">
        <thead style="background:#333333; color: #fff;">
          <tr>
            <th scope="col" class="px-4 py-3">Item</th>
            <th scope="col" class="px-4 py-3">Qty</th>
            <th scope="col" class="px-4 py-3">Price</th>
            <th scope="col" class="px-4 py-3">Delete</th>
          </tr>
        </thead>
        <tbody>
          <!-- Static Rows -->
          <tr>
            <td class="px-4 py-3">Addon</td>
            <td class="px-4 py-3">5</td>
            <td class="px-4 py-3">$45.67</td>
            <td class="px-4 py-3"></td>
          </tr>
          <tr>
            <td class="px-4 py-3">Pav Bhaji</td>
            <td class="px-4 py-3">3</td>
            <td class="px-4 py-3">$36.32</td>
            <td class="px-4 py-3"></td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Summary Section -->
<div class="">
    <p class="d-flex justify-content-between text-white"><span>Subtotal:</span><span>0.00</span></p>
    <p class="d-flex justify-content-between text-white"><span>Product Discount:</span><span>- 0.00</span></p>
    <p class="d-flex justify-content-between text-white"><span>Extra Discount:</span><span>- 0.00</span></p>
    <p class="d-flex justify-content-between text-white"><span>VAT/TAX:</span><span>$10.00 </span></p>

    <p class="d-flex justify-content-between h3 text-white"><span>Total:</span><span>$91.99</span></p>
</div>



<!-- Paid by -->
 <div class="row mt-4">
    <div class="col-4">
    <p class="text-white">Paid By :</p>
</div>
</div>
    <div class="row">
        
        <div class="col-2">
            <button class="btn btn-light custom-btn text-dark hover:text-dark">Cash</button>
        </div>
        <div class="col-2">          
            <button class="btn btn-light custom-btn text-dark hover:text-dark">Card</button>
</div>
        </div>

    <!-- Action Buttons -->
    <div class="d-flex justify-content-between mt-4">
        <button class="btn btn-light custom-btn text-dark hover:text-dark">Cancel Order</button>
        <button class="btn btn-warning custom-border">Place Order</button>
    </div>
  </div>
</div>
    </div>
</div>



@endsection