@if(count($appointments)==0)
<div class="container">
<h3 class="card shadow p-3 mt-6 bg-light">No Trashed Appointments</h3></div> @else
<div class="card shadow" @if (app()->getlocale()=='ar')
    style="direction:rtl"
    @endif>
    <div class="card-header bg-light">
        <div class="row justify-content-center">
            <div class="col-lg col-sm-4 col-xs-4">ID</div>
            <div class="col-lg-2 col-sm-4 col-xs-4">{{ __('lang.patientName') }}</div>
            <div class="col-lg-2 col-sm-4 col-xs-4">{{ __('lang.appointmentDate') }}</div>
            <div class="col-lg-2 col-md-6">{{ __('lang.deleteDate') }}</div>
            <div class="col-lg-5 col-md-6">{{ __('lang.Options') }}</div>
        </div>
    </div>
    <div class="card-body">
        <ul style="padding-right:0" class="list-group list-group-flush">
            @foreach ($appointments as $appointment)
            <li class="list-group-item">
                <div class="row">
                    <div class="col-lg col-sm-4 col-xs-4"> {{$appointment->id}}</div>
                    <div class="col-lg-2 col-sm-4 col-xs-4"><a
                        href="{{ route('patient.show',$appointment->patient[0]->id ) }}">{{$appointment->patient[0]->firstname.' '.$appointment->patient[0]->midname.' '.$appointment->patient[0]->lastname}}</a></div>
                    <div class="col-lg-2 col-sm-4 col-xs-4">{{$appointment->date.' | '.$appointment->time}}</div>
                    <div class="col-lg-2 col-md-6">{{$appointment->updated_at}}</div>
                    <div class="col-lg-5 col-md-6">
                        <div class="row">
                            <div class="col-lg-6 col-md-6"><button class="btn btn-block btn-success"onclick="restoreMe({{ $appointment->id }})"><i class="fas fa-trash-restore"></i> &nbsp; {{ __('lang.Restore') }}</button></div>
                            <div class="col-lg-6 col-md-6"><button class="btn btn-block btn-danger" onclick="deleteMe({{ $appointment->id }})"><i class="fas fa-trash"></i> &nbsp; {{ __('lang.DeletePermanently') }}</button></div>
                        </div>
                    </div>
                </div>

            </li>

            @endforeach

        </ul>
        
        
    </div>
    <div class="card-footer bg-light">
        <div class="row justify-content-center text-center">
            <div class="col">{{ $appointments->links()}}</div>
        </div></div>
</div>@endif