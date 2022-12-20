
        <div class="card border-left-info shadow">
          
            <div class="card-body">
                <div {{(app()->getlocale()=='ar' ? "style=direction:rtl" : '')}} class="row text-center">
                    <div class="col-lg-4 col-md-12">
                        <h4><small>{{__('lang.patientName')}}: </small>
                           <a href="{{ route('patient.show', $appointment->patient[0]->id) }}"> {{$appointment->patient[0]->firstname.' '.$appointment->patient[0]->midname.' '.$appointment->patient[0]->lastname}}</a>
                        </h4>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <h4><small>{{__('lang.appointmentDate')}}: </small> {{$appointment->date.' | '.$appointment->time}}</h4>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="row">
                            <div class="col-3">{{__('lang.status')}}</div>
                            <div class="col">
                                @if ($appointment->isDone=='1')
                                <div class="shadow card bg-success text-white"><strong>DONE</strong></div>
                                @else
                                <div class="shadow card bg-danger text-white"><strong>NOT DONE</strong></div>                                
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <hr><div class="row card-body border-left-info shadow pd-2 m-1"><div class="col">
                <div class="row text-center">
                    <div class="col">

                        <h3> {{__('lang.InpAppointmentNotes')}} </h3>

                    </div>
                </div>
                <div class="row text-center">
                    <div class="col">
                        <div>@if($appointment->notes==null) <h3 class="text-info">No Notes Available
                            </h3> @else <span>{!!$appointment->notes!!}</span> @endif</div>
                    </div>
                </div></div></div>

                @if ($appointment->isDone=='1')
                <br>
                <div {{(app()->getlocale()=='ar' ? "style=direction:rtl" : '')}} class="row text-center">
                    <div class="col-6">
                        <div class="card-body border-left-info shadow"><h4><small>Done at:</small>
                            {{$appointment->payment[0]->created_at}}</h4></div>
                    </div>
                    <div class="col-6">
                        <div class="card-body border-left-info shadow"><h4><small>{{__('lang.payment')}}:</small>
                            {{$appointment->payment[0]->payment}}  @if ($appointment->payment[0]->payment_type=='cash')
                            @if ($appointment->payment[0]->payment_currency=='us')
                                <small>$$</small>
                            @else
                                <small>L.L.</small>
                            @endif
                            @endif</h4></div>
                    </div>
                </div>
                @endif
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
                        <div class="col no-padding"><input disabled name="dist_r_sphere"
                                value="{{$appointment->dist_r_sphere}}" class="form-control text-center"
                                style="display: block; width:100%" type="text"></div>
                    </div>
                    <div class="row">
                        <div class="col no-padding"><input disabled name="dist_l_sphere"
                                value="{{$appointment->dist_l_sphere}}" class="form-control text-center"
                                style="display: block; width:100%" type="text"></div>
                    </div>

                </div>
                <div class="col-3 border ">
                    <div class="row">
                        <div class="col no-padding"><input disabled name="dist_r_cylinder"
                                value="{{$appointment->dist_r_cylinder}}" class="form-control text-center"
                                style="display: block; width:100%" type="text"></div>
                    </div>
                    <div class="row">
                        <div class="col no-padding"><input disabled name="dist_l_cylinder"
                                value="{{$appointment->dist_l_cylinder}}" class="form-control text-center"
                                style="display: block; width:100%" type="text"></div>
                    </div>
                </div>
                <div class="col-2 border ">
                    <div class="row">
                        <div class="col no-padding"><input disabled name="dist_r_axis"
                                value="{{$appointment->dist_r_axis}}" class="form-control text-center"
                                style="display: block; width:100%" type="text"></div>
                    </div>
                    <div class="row">
                        <div class="col no-padding"><input disabled name="dist_l_axis"
                                value="{{$appointment->dist_l_axis}}" class="form-control text-center"
                                style="display: block; width:100%" type="text"></div>
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
                        <div class="col no-padding"><input disabled name="near_r_sphere"
                                value="{{$appointment->near_r_sphere}}" class="form-control text-center"
                                style="display: block; width:100%" type="text"></div>
                    </div>
                    <div class="row">
                        <div class="col no-padding"><input disabled name="near_l_sphere"
                                value="{{$appointment->near_l_sphere}}" class="form-control text-center"
                                style="display: block; width:100%" type="text"></div>
                    </div>

                </div>
                <div class="col-3 border ">
                    <div class="row">
                        <div class="col no-padding"><input disabled name="near_r_cylinder"
                                value="{{$appointment->near_r_cylinder}}" class="form-control text-center"
                                style="display: block; width:100%" type="text"></div>
                    </div>
                    <div class="row">
                        <div class="col no-padding"><input disabled name="near_l_cylinder"
                                value="{{$appointment->near_l_cylinder}}" class="form-control text-center"
                                style="display: block; width:100%" type="text"></div>
                    </div>
                </div>
                <div class="col-2 border ">
                    <div class="row">
                        <div class="col no-padding"><input disabled name="near_r_axis"
                                value="{{$appointment->near_r_axis}}" class="form-control text-center"
                                style="display: block; width:100%" type="text"></div>
                    </div>
                    <div class="row">
                        <div class="col no-padding"><input disabled name="near_l_axis"
                                value="{{$appointment->near_l_axis}}" class="form-control text-center"
                                style="display: block; width:100%" type="text"></div>
                    </div>
                </div>
            </div>
            <div class="row border">
                <div class="col-3 border">P.D/DISTANT</div>
                <div class="col-7 no-padding"><input disabled name="pddist" value="{{$appointment->pddist}}"
                        class="form-control text-center" style="display: block; width:100%" type="text">
                </div>
                <div class="col-2">mm</div>
            </div>
            <div class="row border">
                <div class="col-3 border">P.D/NEAR</div>
                <div class="col-7 no-padding"><input disabled name="pdnear" value="{{$appointment->pdnear}}"
                        class="form-control text-center" style="display: block; width:100%" type="text">
                </div>
                <div class="col-2">mm</div>
            </div>



        </div>
