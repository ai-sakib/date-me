@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form id="form" class="form" method="POST" action="{{ route('register') }}">
                        @csrf
                        <span class="form-group row">
                            <span class="col-md-4"></span>

                            <div class="col-md-6">

                                {{-- @if($errors->any())
                                @foreach($errors->all() as $key => $error)
                                @if($error == "location_not_found") --}}
                                @error('latitude')
                                    <div class="alert alert-danger">
                                        <strong>Please turn on location from your brower</strong>
                                    </div>
                                @enderror
                                {{-- @endif
                                @endforeach
                                @endif --}}
                            </div>
                        </span>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="date_of_birth" class="col-md-4 col-form-label text-md-right">{{ __('Date of Birth') }}</label>

                            <div class="col-md-6">
                                <input id="date_of_birth" type="date" class="form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth" required value="{{ old('date_of_birth') }}" autocomplete="date_of_birth">

                                @error('date_of_birth')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <legend for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</legend>

                            <div class="col-md-6">
                                <div class="form-check">
                                  <input class="form-check-input" type="radio" name="gender" id="gridRadios1" value="1" checked>
                                  <label class="form-check-label" for="gridRadios1">
                                    Male
                                  </label>
                                </div>
                                <div class="form-check">
                                  <input class="form-check-input" type="radio" name="gender" id="gridRadios2" value="2">
                                  <label class="form-check-label" for="gridRadios2">
                                    Female
                                  </label>
                                </div>
                                <div class="form-check">
                                  <input class="form-check-input" type="radio" name="gender" id="gridRadios3" value="3">
                                  <label class="form-check-label" for="gridRadios3">
                                    Others
                                  </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        <input type="hidden" id="latitude" name="latitude">
                        <input type="hidden" id="longitude" name="longitude">
                        
                        
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    getLocation();
    
    function getLocation() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
      } else { 
        console.log("Geolocation is not supported by this browser.");
      }
    }

    function showPosition(position) {
      $('#latitude').val(position.coords.latitude);
      $('#longitude').val(position.coords.longitude);
    }

    // $(document).ready(function() {
    //     var form=$('#form');
    //     form.on('submit', function(e){
    //         e.preventDefault();
    //         var latitude = $('#latitude').val();
    //         var longitude = $('#longitude').val();
    //          console.log(latitude.length,longitude)
    //         if(latitude.length >= 8 && longitude.length >=8){
    //             form.
                
    //         }else{
    //             console.log('location not found');
    //         }
    //     });
    // });
</script>
