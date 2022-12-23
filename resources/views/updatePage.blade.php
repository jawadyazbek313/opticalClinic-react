@extends('layouts.app')
@section('content')
<section class="h-100">
    <header class="container h-100">
      <div class="d-flex align-items-center justify-content-center h-100">
        <div class="d-flex flex-column">
          <h1 class="text align-self-center p-2">
            @switch($response)
              @case('updated')
              Congratulations Your App is using the Latest Version : {{ $version }}
                @break
              @case('connectionError')
              Please Connect to The Internet and Try Again !
              <br>
              If This problem persist Ask for Help at 70365713
                @break
              @default
                
              <i class="fa fa-check-square" style="color:green" aria-hidden="true"></i> Up to date , Version <span style="color: red">{{ $version }}</span>
            @endswitch
          </h1>
       
        </div>
      </div>
    </header>
  </section>

@endsection