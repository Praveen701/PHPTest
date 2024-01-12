@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}

                    <div class="mt-2">
                        <a href="{{url("user/edit")}}" type="button" class="btn btn-dark">Edit Profile</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    setTimeout(function(){
      $("div.alert").remove();
   }, 5000 ); // 5 secs
</script>

@endsection


