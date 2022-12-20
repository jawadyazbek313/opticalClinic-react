@extends('layouts.app')


@section('content')

<div class="container-xl">
    <form autocomplete="off" action="{{ route('appointment.update', $appointment->id)}}" method="post">
        @csrf
        @method('put')
        <div class="row justify-content-center">
            <div class="col-md-12 text-center">
                <div class="card p-4 shadow-sm border-left-info shadow">
                    <div @if (App()->getLocale()=='ar')
                        style="direction: rtl !important"
                        @endif class="card-body ">
                        <div class="row">
                            <div class="col">
                                <h5>{{__('lang.addAppointment')}}</h5>
                                <hr>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 col-md-12">
                                <div class="form-group">
                                    <label for="patient_id">Patient (current: <a
                                            href="{{ route('patient.show', $appointment->patient[0]->id) }}">
                                            {{$appointment->patient[0]->firstname.' '.$appointment->patient[0]->midname.' '.$appointment->patient[0]->lastname}}</a>)</label>
                                    <select name="patient_id" class="selectpicker form-control justify-content-center"
                                        data-live-search="true" data-size="8" data-virtualScroll="true">
                                        <option selected hidden value=""></option>
                                        @foreach ($patients as $patient)
                                        <option @ value="{{$patient->id}}" data-subtext=" {{$patient->dob}} ">
                                            {{$patient->firstname.' '.$patient->midname.' '.$patient->lastname}}
                                        </option>
                                        @endforeach

                                    </select>



                                </div>
                            </div>
                            <div class="col-lg-2 col-md-12">
                                <div style="direction: ltr !important" class="form-group">
                                    <label for="date">{{__('lang.chooseReviewDate')}}</label>
                                    <input id="datepicker" value="{{$appointment->date}}" name="date" />
                                    <script>
                                        $('#datepicker').datepicker({
                                        uiLibrary: 'bootstrap4', iconsLibrary: 'materialicons',weekStartDay: 1,
                                        format: 'yyyy-mm-dd'
                                    });
                                    </script>



                                </div>
                            </div>

                            <div class="col-lg-2 col-md-12">
                                <div style="direction: ltr !important" class="form-group">
                                    <label for="time">{{__('lang.chooseReviewTime')}}</label>
                                    <input id="timepicker" value="{{$appointment->time}}" name="time" />
                                    <script>
                                        $('#timepicker').timepicker({
                                        uiLibrary: 'bootstrap4', iconsLibrary: 'materialicons',
                                        format: 'h:M tt'
                                    });
                                    </script>



                                </div>

                            </div>

                            <div style="margin-top: 25px !important" class="col-lg-4 col-md-12 m-0">


                                <ul style="padding-right: 0 !important" class="list-group justify-content-center">
                                    <li class="list-group-item">

                                        <label for="customCheck1">{{__('lang.isDone')}}</label>
                                        <div class="form-check form-check-inline">
                                            <input {{($appointment->isDone) ? 'checked' : ''}} class="form-check-input"
                                                type="radio" name="isDone" id="inlineRadio1" value="1">
                                            <label class="form-check-label"
                                                for="inlineRadio1">{{__('lang.yes')}}</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input {{($appointment->isDone) ? '' : 'checked'}} class="form-check-input"
                                                type="radio" name="isDone" id="inlineRadio2" value="0">
                                            <label class="form-check-label" for="inlineRadio2">{{__('lang.no')}}</label>
                                        </div>


                                    </li>
                                </ul>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="notes">{{__('lang.InpAppointmentNotes')}}</label>
                                    <textarea rows="2" class="form-control" name="notes"
                                        placeholder="{{__('lang.AppointmentNotesPlaceHolder')}}">{{$appointment->notes}}{{old ('notes') }}</textarea>
                                    <script src="{{ asset('node_modules/tinymce/tinymce.js') }}"></script>
                                    <script>
                                        tinymce.in4it({
                                                        selector:'textarea.form-control',
                                                        
                                                    });
                                    </script>
                                    @error('notes')<div id="error" style="direction: ltr !important;"
                                        class="card text-white bg-danger"><span><i
                                                class="fas fa-exclamation-triangle"></i> {{$message}}</span>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <span id="Payments" {{($appointment->isDone) ? 'style=display:block;' : 'style=display:none;'}} ">
                        <hr>
                        <div class=" row">
                            <div class="col-lg-6 col-md-12">

                                <div class="form-group">
                                    <label for="payment_type">{{__('lang.choosePaymentType')}} @if($appointment->isDone)
                                        (current: {{$appointment->payment[0]->payment_type}}) @endif</label>
                                    <select class="form-control selectpicker" name="payment_type" id="payment_type">
                                        <option selected hidden value="">{{__('lang.chooseHere')}}</option>
                                        <option value="cash">{{__('lang.cash')}}</option>
                                        <option value="gift">{{__('lang.gift')}}</option>
                                        <option value="free">{{__('lang.free')}}</option>
                                        <option value="other">{{__('lang.other')}}</option>
                                    </select>

                                </div>

                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="payment">{{__('lang.payment')}}</label>
                                            <input type="payment"
                                                value="@if ($appointment->isDone) {{$appointment->payment[0]->payment}} @endif"
                                                class="form-control" name="payment" @if(!($appointment->isDone)) disabled @endif id="payment" 
                                                placeholder="{{__('lang.inpPaymentPlaceHolder')}}">

                                        </div>
                                    </div>
                                    <div id="Currency" @if ($appointment->isDone)
                                        {{($appointment->payment[0]->payment_type=='cash') ? 'style="display:block;"' : 'style=display:none;'}}
                                        @else 
                                        style="display:none;"
                                        @endif  class="col-4">
                                        <div class="form-group">
                                            <label for="payment_currency">{{__('lang.choosePaymentCurrency')}}
                                                @if($appointment->isDone)
                                                 @if($appointment->payment[0]->payment_type=='cash') <br> @if($appointment->payment[0]->payment_currency=='lbp') {{ __('lang.lbp') }} @else  {{ __('lang.us') }}) @endif @endif @endif</label>
                                            <select class="form-control selectpicker" name="payment_currency"
                                                id="payment_currency">
                                                <option selected hidden value=""></option>
                                                <option value="lbp">{{__('lang.lbp')}}</option>
                                                <option value="us">{{__('lang.us')}}</option>

                                            </select>

                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    </span>
                </div>
            </div>
        </div>
</div>
<br>
<div class="row justify-content-center">
    <div class="col-md-12 text-center">
        <div class="card p-4 shadow pd-0 m-0 border-left-info">
            <div class="row">
                <div class="col-4 border">

                </div>
                <div class="col-3 border">SPHERE</div>
                <div class="col-3 border">CYLINDER</div>
                <div class="col-2 border">AXIS</div>
            </div>
            <div class="row ">
                <div class="col-4 border">
                    <div class="row" style="height: 76px;">
                        <div class="col-9 border">DISTANT</div>
                        <div class="col-3 justify-content-center">
                            <div style="height: 38px;" class="row border justify-content-center text-center">R
                            </div>
                            <div style="height: 38px;" class="row border justify-content-center text-center">L
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3 border mx-0 pd-0 ">
                    <div class="row">
                        <div class="col no-padding"><input name="dist_r_sphere" value="{{$appointment->dist_r_sphere}}"
                                class="form-control text-center" style="display: block; width:100%" type="text"></div>
                    </div>
                    <div class="row">
                        <div class="col no-padding"><input name="dist_l_sphere" value="{{$appointment->dist_l_sphere}}"
                                class="form-control text-center" style="display: block; width:100%" type="text"></div>
                    </div>

                </div>
                <div class="col-3 border ">
                    <div class="row">
                        <div class="col no-padding"><input name="dist_r_cylinder"
                                value="{{$appointment->dist_r_cylinder}}" class="form-control text-center"
                                style="display: block; width:100%" type="text"></div>
                    </div>
                    <div class="row">
                        <div class="col no-padding"><input name="dist_l_cylinder"
                                value="{{$appointment->dist_l_cylinder}}" class="form-control text-center"
                                style="display: block; width:100%" type="text"></div>
                    </div>
                </div>
                <div class="col-2 border ">
                    <div class="row">
                        <div class="col no-padding"><input name="dist_r_axis" value="{{$appointment->dist_r_axis}}"
                                class="form-control text-center" style="display: block; width:100%" type="text"></div>
                    </div>
                    <div class="row">
                        <div class="col no-padding"><input name="dist_l_axis" value="{{$appointment->dist_l_axis}}"
                                class="form-control text-center" style="display: block; width:100%" type="text"></div>
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-4 border">
                    <div class="row" style="height: 76px;">
                        <div class="col-9 border">NEAR</div>
                        <div class="col-3 justify-content-center">
                            <div style="height: 38px;" class="row border justify-content-center text-center">R
                            </div>
                            <div style="height: 38px;" class="row border justify-content-center text-center">L
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3 border mx-0 pd-0 ">
                    <div class="row">
                        <div class="col no-padding"><input name="near_r_sphere" value="{{$appointment->near_r_sphere}}"
                                class="form-control text-center" style="display: block; width:100%" type="text"></div>
                    </div>
                    <div class="row">
                        <div class="col no-padding"><input name="near_l_sphere" value="{{$appointment->near_l_sphere}}"
                                class="form-control text-center" style="display: block; width:100%" type="text"></div>
                    </div>

                </div>
                <div class="col-3 border ">
                    <div class="row">
                        <div class="col no-padding"><input name="near_r_cylinder"
                                value="{{$appointment->near_r_cylinder}}" class="form-control text-center"
                                style="display: block; width:100%" type="text"></div>
                    </div>
                    <div class="row">
                        <div class="col no-padding"><input name="near_l_cylinder"
                                value="{{$appointment->near_l_cylinder}}" class="form-control text-center"
                                style="display: block; width:100%" type="text"></div>
                    </div>
                </div>
                <div class="col-2 border ">
                    <div class="row">
                        <div class="col no-padding"><input name="near_r_axis" value="{{$appointment->near_r_axis}}"
                                class="form-control text-center" style="display: block; width:100%" type="text"></div>
                    </div>
                    <div class="row">
                        <div class="col no-padding"><input name="near_l_axis" value="{{$appointment->near_l_axis}}"
                                class="form-control text-center" style="display: block; width:100%" type="text"></div>
                    </div>
                </div>
            </div>
            <div class="row border">
                <div class="col-3 border">P.D/DISTANT</div>
                <div class="col-7 no-padding"><input name="pddist" value="{{$appointment->pddist}}"
                        class="form-control text-center" style="display: block; width:100%" type="text">
                </div>
                <div class="col-2">mm</div>
            </div>
            <div class="row border">
                <div class="col-3 border">P.D/NEAR</div>
                <div class="col-7 no-padding"><input name="pdnear" value="{{$appointment->pdnear}}"
                        class="form-control text-center" style="display: block; width:100%" type="text">
                </div>
                <div class="col-2">mm</div>
            </div>
            <br>
            <div class="row">
                <div class="col"><button class="btn btn-primary" type="submit">{{__('lang.addAppointment')}}</button>
                </div>
            </div>

        </div>
    </div>
</div>
</form>
</div>

<script>
    document.getElementById('inlineRadio1').addEventListener('change', function() {
if(this.checked=='1'){
document.getElementById('Payments').style.display = "block";
}else 
document.getElementById('Payments').style.display = "none";


});

document.getElementById('inlineRadio2').addEventListener('change', function() {
if(this.checked=='1'){
document.getElementById('Payments').style.display = "none";
}else 
document.getElementById('Payments').style.display = "block";


});

document.getElementById('payment_type').addEventListener('change', function() {
var x= document.getElementById('payment');
if(this.value!=null) x.disabled = false;
if(this.value!='cash') {x.value=""; x.type='text'; if(document.getElementById('Currency').style.display=="block") {document.getElementById('Currency').style.display="none";}}
else  {x.value=""; x.type='number'; document.getElementById('Currency').style.display="block";}
});
</script>
@endsection