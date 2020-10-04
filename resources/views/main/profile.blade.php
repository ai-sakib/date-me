@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Update Profile') }}</div>

                <div class="card-body">
                    <form id="form" method="POST" action="{{ route('update.profile') }}" enctype= multipart/form-data runat="server">
                        {{ method_field('PUT') }}
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $user->name) }}" required autocomplete="name" autofocus>

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
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" required autocomplete="email">

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
                                <input id="date_of_birth" type="date" class="form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth" required value="{{ old('date_of_birth', $user->profile->date_of_birth) }}" autocomplete="date_of_birth">

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
                                  <input class="form-check-input" type="radio" name="gender" id="gridRadios1" value="1" @if($user->profile->gender == 1) checked @endif>
                                  <label class="form-check-label" for="gridRadios1">
                                    Male
                                  </label>
                                </div>
                                <div class="form-check">
                                  <input class="form-check-input" type="radio" name="gender" id="gridRadios2" value="2" @if($user->profile->gender == 2) checked @endif>
                                  <label class="form-check-label" for="gridRadios2">
                                    Female
                                  </label>
                                </div>
                                <div class="form-check">
                                  <input class="form-check-input" type="radio" name="gender" id="gridRadios3" value="3" @if($user->profile->gender == 3) checked @endif>
                                  <label class="form-check-label" for="gridRadios3">
                                    Others
                                  </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="profile_photo" class="col-md-4 col-form-label text-md-right">{{ __('Profile Photo') }}</label>

                            <div class="col-md-3">
                                <input type="file" onchange="readURL(this)" name="profile_photo" class="form-control-file" id="profile_photo">
                                @error('profile_photo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div {{-- style="height: 100px; width: 100px"  --}}class="col-md-3">
                                @if($user->profile->photo != '' && file_exists(public_path('photos/'.$user->profile->photo)))
                                    <img id="show_image" style="max-width: 100px; max-height: 100px" src="{{ asset('photos/') }}/{{ $user->profile->photo }}">
                                @else
                                    <img id="show_image" style="max-width: 100px; max-height: 100px">
                                @endif
                            </div>
                            
                        </div>

                        
                        
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
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
    function readURL(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
              $('#show_image').attr('src', e.target.result);
          }
          reader.readAsDataURL(input.files[0]);
      }
  }
</script>

