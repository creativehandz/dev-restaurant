@extends('layouts.backend')

@section('content')

     
                    <!-- Start Breadcrumb -->
                    <div class="mb-4">
                        <nav aria-label="breadcrumb">
                            <h1 class="h3 text-white">Activities</h1>
                          <ol class="breadcrumb bg-transparent small p-0">
                            <li class="breadcrumb-item "><a href="./index.html" class="path-color">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Activities</li>
                          </ol>
                        </nav>
                    </div>
                    <!-- End Breadcrumb -->  

<div class="card mb-4">
  <header class="card-header">
    <div class="row">
      <div class="col-lg-9 col-sm-auto">
        <h2 class="h3 card-header-title">Activities</h2>
      </div>
    </div>
  </header>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-hover" id="myTable">
<thead>
  <tr>
    <th scope="col">S.No</th>
    <th scope="col">Placed On</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Phone Number</th>
            <th scope="col">Person</th>
            <th scope="col">Action</th>
  </tr>
</thead>
<tbody>
  <tr>
    <td>1</td>
    <td>today</td>
    <td>David Warner</td>
    <td>david.warner@gmail.com</td>
    <td>7894561230</td>
    <td>2</td>
    <td class="text-center">
												<a id="actions1Invoker" class="link-muted" href="#!" aria-haspopup="true" aria-expanded="false"
												   data-toggle="dropdown">
													<i class="fa fa-sliders-h"></i>
												</a>

												<div class="dropdown-menu dropdown-menu-right dropdown" style="width: 150px;" aria-labelledby="actions1Invoker">
													<ul class="list-unstyled mb-0">
														<li>
															<a class="d-flex align-items-center link-muted py-2 px-3" href="#!">
																<i class="fa fa-plus mr-2"></i> Add
															</a>
														</li>
														<li>
															<a class="d-flex align-items-center link-muted py-2 px-3" href="#!">
																<i class="fa fa-minus mr-2"></i> Remove
															</a>
														</li>
													</ul>
												</div>
											</td>
    
  </tr>
</tbody>
      </table>
    </div>
  </div>
</div>        



@endsection