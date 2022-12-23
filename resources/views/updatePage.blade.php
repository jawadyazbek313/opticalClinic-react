@extends('layouts.app')
@section('content')
<section class="h-100">
    <header class="container h-100">
      <div class="d-flex align-items-center justify-content-center h-100">
        <div class="d-flex flex-column">
          <h1 class="text align-self-center p-2">
            @switch($response)
              @case('updated')
              <i class="fa fa-check-square" style="color:green" aria-hidden="true"></i> Updated Successfully!
              <br>
              Congratulations Your App is using the Latest Version : {{ $version }}
                @break
              @case('connectionError')
              <div class="jumbotron">
                <h1 class="display-5"><div class="alert alert-danger" role="alert">
                  <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Please Connect to The Internet and Try Again !
                </div></h1>
                <p class="lead">If This problem persist Ask for Help at 70 365 713</p>
                <hr class="my-4">
                <p>Current Version : <span style="color: red">{{ $version }}</span></p>
              </div>

                @break
              @default
              <div class="alert alert-success" role="alert">
              <i class="fa fa-check-square" style="color:green" aria-hidden="true"></i> Up to date , Version <span style="color: red">{{ $version }}</span></div>
            @endswitch
          </h1>
       
        </div>
      </div>
    </header>
  </section>

@endsection