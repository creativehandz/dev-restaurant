@extends('layouts.backend')

@section('content')

<!-- Start Breadcrumb -->
<div class="mb-4">
    <nav aria-label="breadcrumb">
        <h1 class="h3 text-white">Add New Product</h1>
        <ol class="breadcrumb bg-transparent small p-0">
            <li class="breadcrumb-item "><a href="./index.html" class="path-color">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add New Product</li>
        </ol>
    </nav>
</div>
<!-- End Breadcrumb -->


<div class="row">

    <div class="col-lg-6">
        <div class="card mb-4 h-100">
            <header class="card-header">
                <div class="row">
                    <div class="col-5">
                        <h2 class="h3 card-header-title">English(EN)</h2>
                    </div>
                </div>
            </header>

            <div class="card-body">
                <div class="row">
                    <div class="col-5">
                        <h2 class="h3 card-header-title">Parent Branch</h2>
                    </div>
                </div>
                <div class="row mt-2 ml-1 mr-1">
                    <select class="form-control custom-input-btn border border-gray-300 rounded-md p-2 w-full">
                        <option value="">--Main Branch--</option>
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

                <div class="row mt-4">
                    <div class="col-5">
                        <h2 class="h3 card-header-title">Name (EN)</h2>
                    </div>
                </div>
                <div class="row mt-2 ml-1 mr-1">
                    <input type="text" placeholder="New Product" class="form-control custom-input-btn">
                </div>

                <div class="row mt-4">
                    <div class="col-5">
                        <h2 class="h3 card-header-title">Short Description (EN)</h2>
                    </div>
                </div>
                <div class="row mt-2 ml-1 mr-1">
                    <textarea placeholder="Tell in brief about your product" class="form-control custom-input-btn"
                        rows="3"></textarea>
                </div>

            </div>
        </div>
    </div>

    <div class="col-lg-6 mt-4 mt-lg-0">
        <div class="card mb-4 h-100">
            <header class="card-header">
                <div class="row">
                    <div class="col-5">
                        <h2 class="h3 card-header-title">Product Image
                        </h2>
                    </div>
                </div>
            </header>

            <div class="card-body">
                <div class="d-flex align-items-center justify-content-center mt-4">
                    <div class="upload-file">
                        <input type="file" name="image" accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*"
                            class="upload-file__input">
                        <div class="upload-file__img_drag upload-file__img">
                            <img width="176"
                                src="https://admin.road2xtechnology.com/public/assets/admin/img/icons/upload_img.png"
                                alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-lg-6 mt-4">
        <div class="row gap-2">
            <div class="col-12">
                <div class="card mb-4 h-100">
                    <header class="card-header">
                        <div class="row">
                            <div class="col-5">
                                <h2 class="h3 card-header-title">Category</h2>
                            </div>
                        </div>
                    </header>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="input-label" for="exampleFormControlSelect1">
                                        Category
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select name="category_id" id="main-categories"
                                        class="form-control custom-input-btn border border-gray-300 rounded-md p-2 w-full"
                                        onchange="" data-select2-id="main-categories" tabindex="-1" aria-hidden="true">
                                        <option selected="" disabled="" data-select2-id="3">---Select---</option>
                                        <option value="3" data-select2-id="4">Pav Bhaji</option>
                                        <option value="4" data-select2-id="5">Pulav</option>
                                        <option value="5" data-select2-id="6">Roll</option>
                                        <option value="6" data-select2-id="7">Chinese</option>
                                        <option value="7" data-select2-id="8">Panipuri</option>
                                        <option value="8" data-select2-id="9">Shots</option>
                                        <option value="9" data-select2-id="10">Lassi</option>
                                        <option value="10" data-select2-id="11">Sandwiches</option>
                                        <option value="11" data-select2-id="12">Milk Shakes</option>
                                        <option value="12" data-select2-id="13">Drinks</option>
                                        <option value="13" data-select2-id="14">Tea</option>
                                        <option value="14" data-select2-id="15">Maska Bun</option>
                                        <option value="15" data-select2-id="16">Meetha Paan</option>
                                        <option value="17" data-select2-id="17">Pizza</option>
                                        <option value="19" data-select2-id="18">Wrap</option>
                                        <option value="20" data-select2-id="19">Plates</option>
                                        <option value="21" data-select2-id="20">Wings</option>
                                        <option value="22" data-select2-id="21">Salad</option>
                                        <option value="23" data-select2-id="22">poutine</option>
                                        <option value="25" data-select2-id="23">Sides</option>
                                        <option value="27" data-select2-id="24">Beverages</option>
                                        <option value="28" data-select2-id="25">Combos</option>
                                        <option value="29" data-select2-id="26">Popular</option>
                                        <option value="30" data-select2-id="27">Main</option>
                                    </select>

                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="input-label" for="exampleFormControlSelect1">Sub category<span
                                            class="input-label-secondary"></span></label>
                                    <select name="sub_category_id" id="sub-categories"
                                        class="form-control custom-input-btn border border-gray-300 rounded-md p-2 w-full"
                                        onchange="" data-select2-id="sub-categories" tabindex="-1" aria-hidden="true">
                                        <option selected="" disabled="" data-select2-id="29">---Select---</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="input-label" for="exampleFormControlInput1">
                                        Item Type
                                        <span class="text-danger">*</span>
                                    </label>

                                    <select name="item_type"
                                        class="form-control custom-input-btn border border-gray-300 rounded-md p-2 w-full"
                                        data-select2-id="30" tabindex="-1" aria-hidden="true">
                                        <option selected="" disabled="" data-select2-id="32">---Select---</option>
                                        <option value="0" data-select2-id="33">Product Item</option>
                                        <option value="1" data-select2-id="34">Set menu</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="input-label">
                                        Product Type
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select name="product_type"
                                        class="form-control custom-input-btn border border-gray-300 rounded-md p-2 w-full"
                                        data-select2-id="35" tabindex="-1" aria-hidden="true">
                                        <option selected="" disabled="" data-select2-id="37">---Select---</option>
                                        <option value="veg" data-select2-id="38">Veg</option>
                                        <option value="non_veg" data-select2-id="39">Nonveg</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 mt-4">
                <div class="card mb-4 h-100">
                    <header class="card-header">
                        <div class="row">
                            <div class="col-5">
                                <h2 class="h3 card-header-title">Price Information</h2>
                            </div>
                        </div>
                    </header>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="input-label">Default Price
                                        <span class="text-danger">*</span></label>
                                    <input type="number" min="0" step="any" value="1" name="price"
                                        class="form-control custom-input-btn" placeholder="Ex : 100" required="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="input-label">Discount Type
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select name="discount_type"
                                        class="form-control custom-input-btn border border-gray-300 rounded-md p-2 w-full"
                                        id="discount_type" data-select2-id="discount_type" tabindex="-1"
                                        aria-hidden="true">
                                        <option selected="" disabled="" data-select2-id="41">---Select---</option>
                                        <option value="percent" data-select2-id="42">Percentage</option>
                                        <option value="amount" data-select2-id="43">Amount</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label id="discount_label" class="input-label">Discount
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input id="discount_input" type="number" min="0" name="discount"
                                        class="form-control custom-input-btn" placeholder="Ex : 5%" required="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="input-label">Tax Type
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select name="tax_type"
                                        class="form-control custom-input-btn border border-gray-300 rounded-md p-2 w-full"
                                        id="tax_type" data-select2-id="tax_type" tabindex="-1" aria-hidden="true">
                                        <option selected="" disabled="" data-select2-id="45">---Select---</option>
                                        <option value="percent" data-select2-id="46">Percentage</option>
                                        <option value="amount" data-select2-id="47">Amount</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label id="tax_label" class="input-label" for="exampleFormControlInput1">Tax Rate
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input id="tax_input" type="number" min="0" step="any" name="tax"
                                        class="form-control custom-input-btn" placeholder="Ex : $100" required="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6 mt-4">
        <div class="row gap-2">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="">
                                Turning visibility off will not show this<br> product in the user app and website
                            </div>
                            <div class="form-check form-switch">

                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
                                <label class="form-check-label" for="flexSwitchCheckChecked">Visibility</label>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-12 mt-4">
                <div class="card h-100">
                    <div class="card-header">
                        <h2 class="h3 card-header-title">Availability</h2>
                    </div>
                    <div class="card-body">
                        <div class="row gap-2">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="input-label">Available From</label>
                                    <input type="time" name="available_time_starts"
                                        class="form-control custom-input-btn" value="10:30:00"
                                        placeholder="Ex : 10:30 am" required="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="input-label">Available Till</label>
                                    <input type="time" name="available_time_ends" class="form-control custom-input-btn"
                                        value="19:30:00" placeholder="5:45 pm" required="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 mt-4">
                <div class="card h-100">
                    <div class="card-header">
                        <h2 class="h3 card-header-title">Addons</h2>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="input-label">Select Addons</label>
                            <select name="addon_ids[]"
                                class="form-control custom-input-btn border border-gray-300 rounded-md p-2 w-full"
                                id="choose_addons" data-select2-id="choose_addons" aria-hidden="true">
                                <option value="">Select Addons</option>
                                <option value="4">Garlic base</option>
                                <option value="2">Jalepino</option>
                                <option value="3">Pineapple</option>
                                <option value="5">spicy</option>
                                <option value="1">Tomatos</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 mt-4">
                <div class="card h-100">
                    <div class="card-header">
                        <h2 class="h3 card-header-title">Tags</h2>

                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="">
                                    <label class="input-label">Search tag</label>
                                    <input type="text" class="form-control custom-input-btn" name="tags"
                                        placeholder="Enter tags" data-role="tagsinput">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

<div class="card mt-4">
    <div class="card-header">
        <h2 class="h3 card-header-title">Product Variations</h2>
    </div>
    <div class="card-body pb-0">
        <div class="row">
            <div class="col-md-12">
                <div id="add_new_option">
                </div>
                <br>
                <div class="">
                    <a class="btn btn-outline-success" id="add_new_option_button">Add New Variation</a>
                </div>
                <br><br>
            </div>
        </div>
    </div>
</div>

<div class="d-flex justify-content-end mt-4">
    <button type="reset" class="btn btn-light custom-btn text-dark hover:text-dark">Reset</button>
    <button type="submit" class="ml-3 btn btn-warning custom-border">Submit</button>
</div>

@endsection