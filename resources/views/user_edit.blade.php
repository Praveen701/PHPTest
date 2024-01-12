@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit User Details') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" id="success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                    <form method="POST" action="{{ route('update.user') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"  value="{{\Auth::user()->name}}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{\Auth::user()->email}}"  required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="phone" class="col-md-4 col-form-label text-md-end">{{ __('Phone') }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{\Auth::user()->phone}}" required>

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="salary_id" class="col-md-4 col-form-label text-md-end">{{ __('Salary') }}</label>

                            <div class="col-md-6">

                                <select name="salary_id" id="salary_id" class="form-control @error('salary') is-invalid @enderror" required>
                                    @foreach ($salaries as $salary)
                                    <option value="{{$salary->id}}" selected>{{$salary->value}}</option>
                                    @endforeach
                                   
                                   
                                </select>



                                @error('salary_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="salary" class="col-md-4 col-form-label text-md-end">{{ __('Profile Photo') }}</label>

                            <div class="col-md-6">

                                <input name="profile_photo" type="file" accept="image/*" id="profile_photo" class="form-control image_profile @error('profile_photo') is-invalid @enderror" @if(\Auth::user()->profile_photo != null) @else required @endif >

                              
                                <div id="image_pre">
                                   <img id="image_preview" width="100" height="100" src="{{url(\Auth::user()->profile_photo)}}" alt="">
                                </div>
                                   

                                @error('profile_photo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Gender') }}</label>

                            <div class="col-md-6">
                         

                                <select name="gender" id="gender" class="form-control @error('gender') is-invalid @enderror" required>
                                    <option value="Male" @if(\Auth::user()->gender == "Male") selected @endif>Male</option>
                                    <option value="Female" @if(\Auth::user()->gender == "Female") selected @endif >Female</option>
                                    <option value="Others" @if(\Auth::user()->gender == "Others") selected @endif >Others</option>
                                </select>



                                @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update Changes') }}
                                </button>
                            </div>
                        </div>
                    </form>
                     
                </div>
            </div>


            <div class="mt-2 card">
                <div class="card-header">{{ __('Update Password') }}</div>
                <div class="card-body">
                    <form action="{{route('update.user_password')}}" method="POST">
                        @csrf
                    <div class="row mb-3">
                        <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Update Password') }}
                            </button>
                        </div>
                    </div>
                </form>
                </div>
            </div>



        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        const photoInp = $("#profile_photo");
        photoInp.change(function (e) {
        
                file = this.files[0];
                if (file) {
                    let reader = new FileReader();
                    reader.onload = function (event) {
                        $("#image_preview")
                            .attr("src", event.target.result);
                    };
                    reader.readAsDataURL(file);
                }
            });
            
            setTimeout(function(){
      $("#success").remove();
   }, 3000 ); 

    });
</script>


<style scoped>


.imageThumb {
  width: 100px;
  height: 100px;
}

</style>
@endsection
