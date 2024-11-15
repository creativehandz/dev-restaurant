@include('layouts.frontend')

@yield('contents')
  

<div class="row justify-content-center mt-5">
    <div class="col-md-8">

        <div class="card">
            <div class="card-header">Book Table</div>
 <div class="card-body">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        {{ $message }}
                    </div>
                @else
                         
                @endif   
                  <!-- Way 1: Display All Error Messages -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif             
            </div>

            <div class="card-body">
                <form action="{{ url('book-order') }}" method="post">
                   {{ csrf_field() }}

<div class="row flex-column">

<div class="form-group">
<label for="name" class="form-label"> Select  People</label>
<select class="form-control" name="person">
<option class="text-black" value="2">2 People</option>
<option class="text-black" value="3">3 People</option>
<option class="text-black" value="4">4 People</option>
<option class="text-black" value="5">5 People</option>
<option class="text-black" value="6">6 People</option>
<option class="text-black" value="7">7 People</option>
<option class="text-black" value="8">8 People</option>
<option class="text-black" value="9">9 People</option>
<option class="text-black" value="10">10 People</option>
</select>
</div>



<div class="form-group">
<label for="" class="col-md-4 col-form-label text-md-end text-start">Date</label>
<input type="date" class="form-control" id="password_confirmation" name="date">
</div>
<div class="form-group">
<label for="" class="col-md-4 col-form-label text-md-end text-start">Time</label>
<input type="time" class="form-control" id="" name="time">
</div>
<div class="form-group">
<label for="name" class="col-md-4 col-form-label text-md-end text-start"> First Name</label>
<input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="firstname" value="{{ old('name') }}">
</div>
<div class="form-group">
<label for="name" class="form-label text-md-end text-start"> Last Name</label>
<input type="text" class="form-control @error('lastname') is-invalid @enderror" id="" name="lastname" value="{{ old('lastname') }}">
</div>
<div class="form-group">    
<label for="" class="form-label text-md-end text-start">Phone</label>
<input type="text" class="form-control" id=""  maxlength="11" name="phone">
</div>
  
<div class="form-group">
<label for="email" class="form-label text-md-end text-start">Email </label>
<input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
</div>

<div class="form-group">
<select class="form-control" name="occasion">
<option value="Select An Occasion">Select An Occasion</option>
<option value="Birthday Party">Birthday Party</option>
<option value="Anniversary Party">Anniversary Party</option>
<option value="Other">Other</option>
</select>
</div>
<div class="form-group">
<label for="" class="col-form-label text-md-end text-start">Comments</label>
<textarea class="form-control" id="" name="comment"></textarea>
</div>

<input type="hidden" value="no" name="promocode">
                    
                    <div class="form-group">
                        <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="save">
                    </div>
                    
                </form>
            </div>
        </div>
    </div>    
</div>
    
