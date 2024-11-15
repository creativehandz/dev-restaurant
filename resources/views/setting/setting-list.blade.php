 @extends('layouts.backend')

 @section('content')

 <!-- End Breadcrumb -->
 <div class="mb-4">
         <nav aria-label="breadcrumb">
                 <h1 class="h3 text-white">Setting</h1>
                 <ol class="breadcrumb bg-transparent small p-0">
                         <li class="breadcrumb-item"><a href="./index.html" class="path-color">Home</a></li>
                         <li class="breadcrumb-item active" aria-current="page">Setting</li>
                 </ol>
         </nav>
 </div>
 <!-- End Breadcrumb -->
 @if (Session::has('message'))
 <div class="alert alert-success" role="alert">
         {{ Session::get('message') }}
 </div>
 @endif
 @if (Session::has('err_message'))
 <div class="alert alert-danger" role="alert">
         {{ Session::get('err_message') }}
 </div>
 @endif
 <form action="{{ route('set-list') }}" method="POST">
         @csrf
         <div class="card mb-4 col-md-6">
                 <header class="card-header">
                         <div class="row">
                                 <div class="col-lg-9 col-sm-auto">
                                         <h2 class="h3 card-header-title">Profile Setting</h2>
                                 </div>
                         </div>
                 </header>
                 <div class="card-body">
                         @if(count($settings) > 0)
                         @foreach($settings as $setting)
                         @if($setting->key == 'address')
                         <div class="form-group mb-4">
                                 <label for="defaultInput">Address</label>
                                 <textarea id="defaultInput" name="address" class="form-control" placeholder="Enter your address">{{ $setting->value ?? '' }}</textarea>
                         </div>
                         @endif
                         @if($setting->key == 'phone')
                         <div class="form-group mb-4">
                                 <label for="defaultInput">Phone</label>
                                 <input id="defaultInput" name="phone" class="form-control" type="text" placeholder="Enter your phone no" aria-describedby="emailHelp" value="{{ $setting->value ?? '' }}">
                         </div>
                         @endif
                         @if($setting->key == 'licences')
                         <div class="form-group mb-4">
                                 <label for="defaultInput">Licences</label>
                                 <input id="defaultInput" class="form-control" type="text" placeholder="Enter your Licence" aria-describedby="emailHelp" value="{{ $setting->value ?? '' }}">
                         </div>
                         @endif
                         @if($setting->key == 'time_schedule')
                         <div class="form-group mb-4">
                                 <div class="row mb-2">
                                         <div class="col-4">
                                                 <label for="defaultInput">Days</label>
                                         </div>
                                         <div class="col-4">
                                                 <label for="defaultInput">Start Time</label>
                                         </div>
                                         <div class="col-4">
                                                 <label for="defaultInput">End Time</label>
                                         </div>
                                 </div>
                                 <?php $timeSchedule = json_decode($setting->value); ?>
                                 @if($timeSchedule)
                                 @foreach($timeSchedule as $day => $time)
                                 <div class="row mb-2 align-items-center">
                                         <div class="col-4">
                                                 <label for="defaultInput">{{ ucfirst($day) }}</label>
                                         </div>
                                         <div class="col-4">
                                                 <input type="time" class="form-control" id="defaultInputime1" name="{{ $day }}_start_time" value="{{ $time->start_time }}">
                                         </div>
                                         <div class="col-4">
                                                 <input type="time" class="form-control" id="defaultInputime2" name="{{ $day }}_end_time" value="{{ $time->end_time }}">
                                         </div>
                                 </div>
                                 @endforeach
                                 @endif

                         </div>
                         @endif
                         @if($setting->key == 'location')
                         <div class="form-group mb-4">
                                 <label for="defaultInputime">Map Location</label>
                                 <textarea id="defaultInput" name="location" class="form-control" placeholder="Enter your map location">{{ $setting->value ?? '' }}</textarea>
                         </div>
                         @endif
                         @if($setting->key == 'email')
                         <div class="form-group mb-4">
                                 <label for="defaultInputime">Email</label>
                                 <input type="email" name="email" class="form-control" id="defaultInputime" value="{{ $setting->value ?? '' }}">
                         </div>
                         @endif
                         @if($setting->key == 'google_review')

                         <div class="form-group mb-4">
                                 <label for="defaultInputime">Google Review Link</label>
                                 <input type="text" name="google_review" class="form-control" id="defaultInputime" value="{{ $setting->value ?? '' }}">
                         </div>
                         @endif
                         @if($setting->key == 'facebook')

                         <div class="form-group mb-4">
                                 <label for="defaultInputime">Facebook Link</label>
                                 <input type="text" name="facebook" class="form-control" id="defaultInputime" value="{{ $setting->value ?? '' }}">
                         </div>
                         @endif
                         @if($setting->key == 'instagram')

                         <div class="form-group mb-4">
                                 <label for="defaultInputime">Instagram Link</label>
                                 <input type="text" name="instagram" class="form-control" id="defaultInputime" value="{{ $setting->value ?? '' }}">
                         </div>
                         @endif
                         @if($setting->key == 'tiktok')

                         <div class="form-group mb-4">
                                 <label for="defaultInputime">TikTok Link</label>
                                 <input type="text" name="tiktok" class="form-control" id="defaultInputime" value="{{ $setting->value ?? '' }}">
                         </div>
                         @endif
                         @if($setting->key == 'whatsapp')

                         <div class="form-group mb-4">
                                 <label for="defaultInputime">Whatsapp Number</label>
                                 <input type="text" name="whatsapp" class="form-control" id="defaultInputime" value="{{ $setting->value ?? '' }}">
                         </div>
                         @endif

                         @endforeach
                         @endif

                         <div class="form-group mb-4">
                                 <button type="submit" class="btn btn-warning custom-border form-control">Submit</button>
                         </div>

                 </div>
         </div>
 </form>
 @endsection