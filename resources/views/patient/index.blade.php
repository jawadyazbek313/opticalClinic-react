@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
                <div class="card border-left-info shadow">
                    <div class="card-header text-center"><h4>{{__('lang.listPatient')}}</h4></div>
                    <div class="card-body">
                        {!!$dataTable->table()!!}

                    </div>
                </div>

        </div>
    </div>
</div>
{!!$dataTable->scripts()!!} 

<script>
    $("#patient-table").addClass("table-hover").addClass("table-bordered").addClass("text-center");


</script>
@endsection