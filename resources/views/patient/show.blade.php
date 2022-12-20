@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row @if (app()->getlocale() == 'ar') rtl @endif">
            <div class="col-lg-8 col-md-12 mb-4">
                <div
                    class="card h-100 {{ app()->getlocale() == 'ar' ? 'border-right-primary' : 'border-left-primary' }} justify-conternt-center text-center shadow-sm">
                    <div class="card-header bg-light">
                        {{ __('lang.patientInfo') }} <a
                            class="btn btn-outline-success btn-sm {{ app()->getlocale() == 'ar' ? 'float-right' : 'float-left' }}"
                            href="{{ route('patient.edit', $patient) }}"><i class="fa fa-pencil-alt"></i></a>
                    </div>
                    <div class="card-body">
                        <div class="row p-2">
                            <div style="transition: all .5s ease-Out;"
                                class="col hoverbadges badge badge-primary border shadow-sm">
                                <h3 class="mt-2"><i
                                        class="fa fa-user {{ app()->getlocale() == 'ar' ? 'float-right mr-2' : 'float-left ml-2' }} "></i>
                                    {{ __('lang.patientName') }}:&nbsp;&nbsp;&nbsp;&nbsp;
                                    {{ $patient->firstname . ' ' . $patient->midname . ' ' . $patient->lastname }} </h3>
                            </div>
                        </div>
                        <div class="row p-2">
                            <div style="transition: all .5s ease-Out;"
                                class="col-lg-4 col-md-6 hoverbadges badge badge-primary border shadow-sm">
                                <h3 class="mt-2"><i
                                        class="fa {{ $patient->gender == 'male' ? 'fa-mars' : 'fa-venus' }} {{ app()->getlocale() == 'ar' ? 'float-right mr-2' : 'float-left ml-2' }} "></i>
                                    {{ __('lang.Gender') }}:&nbsp;&nbsp;&nbsp;&nbsp;
                                    {{ $patient->gender == 'male' ? __('lang.genderOptionMale') : __('lang.genderOptionFemale') }}
                                </h3>
                            </div>
                            <div style="transition: all .5s ease-Out;"
                                class="marginTopResponsive hoverbadges col-lg-8 col-md-6 badge badge-primary border shadow-sm">
                                <h3 class="mt-2"><i
                                        class="fa fa-tint {{ app()->getlocale() == 'ar' ? 'float-right mr-2' : 'float-left ml-2' }} "></i>
                                    {{ __('lang.inpBloodType') }}:&nbsp;&nbsp;&nbsp;&nbsp; {{ $patient->bloodtype }}
                                </h3>
                            </div>
                        </div>


                        <div class="row p-2">
                            <div style="transition: all .5s ease-Out;"
                                class="col-lg-8 col-md-12 hoverbadges badge badge-primary border shadow-sm">
                                <h3 class="mt-2"><i
                                        class="fa fa-calendar-alt {{ app()->getlocale() == 'ar' ? 'float-right mr-2' : 'float-left ml-2' }} "></i>
                                    {{ __('lang.dob') }}:&nbsp;&nbsp;&nbsp;&nbsp; {{ $patient->dob }} </h3>
                            </div>
                            <div style="transition: all .5s ease-Out;"
                                class="marginTopResponsive col-lg-4 col-md-12 hoverbadges badge badge-primary border shadow-sm">
                                <h3 class="mt-2"><i
                                        class="fa fa-calendar-alt {{ app()->getlocale() == 'ar' ? 'float-right mr-2' : 'float-left ml-2' }} "></i>
                                    {{ __('lang.age') }}:&nbsp;&nbsp;&nbsp;&nbsp; @php
                                        $date = Carbon\Carbon::parse($patient->dob)->age;
                                        
                                        echo $date;
                                    @endphp
                                    {{ __('lang.Year') }} </h3>
                            </div>
                        </div>

                        <div class="row p-2">
                            <div style="transition: all .5s ease-Out;"
                                class="col hoverbadges badge badge-primary border shadow-sm">
                                <h3 class="mt-2"><i
                                        class="fa fa-user {{ app()->getlocale() == 'ar' ? 'float-right mr-2' : 'float-left ml-2' }} "></i>
                                    {{ __('lang.inpInsuranceType') }}:&nbsp;&nbsp;&nbsp;&nbsp; {{ $patient->insurance }}
                                </h3>

                            </div>
                        </div>
                    </div>
                </div>


            </div>


            <div class="col-lg-4 col-md-12 mb-4">

                <div
                    class="card h-100 {{ app()->getlocale() == 'ar' ? 'border-right-success' : 'border-left-success' }} justify-conternt-center text-center shadow-sm">
                    <div class="card-header bg-light">{{ __('lang.Options') }}</div>
                    <div class="card-body">
                        <div class="row p-2">
                            <button class="showAppointments btn btn-lg btn-block btn-outline-success" >
                                <i class="far fa-lg fa-calendar-alt"></i>&nbsp; {{ __('lang.ShowAppointments') }}</button>
                        </div>
                        <div class="row p-2">
                            <button class="showPayments btn btn-lg btn-block btn-outline-success" data-toggle="modal"
                            data-target="#paymentsModal">
                                <i class="fas fa-lg fa-dollar-sign"></i>&nbsp; {{ __('lang.ShowPayments') }}</button>
                        </div>
                        <div class="row p-2">
                            <button onclick="showEyeDetailFields()" id="btnToggleEyeDetails"
                                class="showEyeDetails btn btn-lg btn-block btn-outline-success">
                                <i class="fas fa-lg fa-eye"></i>&nbsp; {{ __('lang.showMoreDetails') }}</button>
                        </div>


                    </div>
                </div>
            </div>
        </div>

        <div id="EyeDetail" class="row  justify-content-center" style="display: none; margin-bottom: 75px">
            <div class="col-lg-12 col-md-12">
                <div
                    class="card text-center {{ app()->getlocale() == 'ar' ? 'border-right-success' : 'border-left-success' }}">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 col-md-12">
                                <div class="row">
                                    <div class="col">
                                        <img style=" -webkit-transform: scaleX(-1);
                                        transform: scaleX(-1);" src="{{ asset('images/Eye.png') }}">

                                        <h4>OD EYE (Right Eye)</h4>
                                        <hr>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="OD_VA">OD VA</label>
                                            <input disabled value="{{ $patient->OD_VA }}" type="text"
                                                class="form-control" name="OD_VA" placeholder="">

                                        </div>
                                    </div>
                                </div>
                                {{-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - --}}
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="OD_AUTO">OD AUTO</label>
                                            <input disabled value="{{ $patient->OD_AUTO }}" type="text"
                                                class="form-control" name="OD_AUTO" placeholder="">

                                        </div>
                                    </div>
                                </div>
                                {{-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - --}}
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="OD_BCVA_FAR">OD BCVA FAR</label>
                                            <input disabled value="{{ $patient->OD_BCVA_FAR }}" type="text"
                                                class="form-control" name="OD_BCVA_FAR" placeholder="">

                                        </div>
                                    </div>
                                </div>
                                {{-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - --}}
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="OD_NEAR">OD NEAR</label>
                                            <input disabled value="{{ $patient->OD_NEAR }}" type="text"
                                                class="form-control" name="OD_NEAR" placeholder="">

                                        </div>
                                    </div>
                                </div>
                                {{-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - --}}
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="OD_AUTO_AFTER_CYCLO">OD AUTO AFTER CYCLO</label>
                                            <input disabled value="{{ $patient->OD_AUTO_AFTER_CYCLO }}" type="text"
                                                class="form-control" name="OD_AUTO_AFTER_CYCLO" placeholder="">

                                        </div>
                                    </div>
                                </div>
                                {{-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - --}}
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="OD_BUT">OD BUT</label>
                                            <input disabled value="{{ $patient->OD_BUT }}" type="text"
                                                class="form-control" name="OD_BUT" placeholder="">

                                        </div>
                                    </div>
                                </div>
                                {{-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - --}}
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="OD_IOP">OD IOP</label>
                                            <input disabled value="{{ $patient->OD_IOP }}" type="text"
                                                class="form-control" name="OD_IOP" placeholder="">

                                        </div>
                                    </div>
                                </div>
                                {{-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - --}}

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="OD_LIDS">OD LIDS</label>
                                            <input disabled value="{{ $patient->OD_LIDS }}" type="text"
                                                class="form-control" name="OD_LIDS" placeholder="">

                                        </div>
                                    </div>
                                </div>
                                {{-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - --}}
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="OD_CORNEA">OD CORNEA</label>
                                            <input disabled value="{{ $patient->OD_CORNEA }}" type="text"
                                                class="form-control" name="OD_CORNEA" placeholder="">

                                        </div>
                                    </div>
                                </div>
                                {{-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - --}}
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="OD_CONJUNCTIVA">OD CONJUNCTIVA</label>
                                            <input disabled value="{{ $patient->OD_CONJUNCTIVA }}" type="text"
                                                class="form-control" name="OD_CONJUNCTIVA" placeholder="">

                                        </div>
                                    </div>
                                </div>
                                {{-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - --}}
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="OD_IRIS">OD IRIS</label>
                                            <input disabled value="{{ $patient->OD_IRIS }}" type="text"
                                                class="form-control" name="OD_IRIS" placeholder="">

                                        </div>
                                    </div>
                                </div>
                                {{-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - --}}
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="OD_AC">OD AC</label>
                                            <input disabled value="{{ $patient->OD_AC }}" type="text"
                                                class="form-control" name="OD_AC" placeholder="">

                                        </div>
                                    </div>
                                </div>
                                {{-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - --}}
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="OD_LENS">OD LENS</label>
                                            <input disabled value="{{ $patient->OD_LENS }}" type="text"
                                                class="form-control" name="OD_LENS" placeholder="">

                                        </div>
                                    </div>
                                </div>
                                {{-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - --}}
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="OD_VITREOUS">OD VITREOUS</label>
                                            <input disabled value="{{ $patient->OD_VITREOUS }}" type="text"
                                                class="form-control" name="OD_VITREOUS" placeholder="">

                                        </div>
                                    </div>
                                </div>
                                {{-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - --}}
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="OD_CD">OD CD</label>
                                            <input disabled value="{{ $patient->OD_CD }}" type="text"
                                                class="form-control" name="OD_CD" placeholder="">

                                        </div>
                                    </div>
                                </div>
                                {{-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - --}}
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="OD_FUNDUS">OD FUNDUS</label>
                                            <input disabled value="{{ $patient->OD_FUNDUS }}" type="text"
                                                class="form-control" name="OD_FUNDUS" placeholder="">

                                        </div>
                                    </div>
                                </div>
                                {{-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - --}}

                            </div>

                            <div class="col-lg-6 col-md-12">
                                <div class="row">
                                    <div class="col">
                                        <img src="{{ asset('images/Eye.png') }}">
                                        <h4>OS EYE (Left Eye)</h4>
                                        <hr>


                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="OS_VA">OS VA</label>
                                            <input disabled value="{{ $patient->OS_VA }}" type="text"
                                                class="form-control" name="OS_VA" placeholder="">

                                        </div>
                                    </div>
                                </div>
                                {{-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - --}}
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="OS_AUTO">OS AUTO</label>
                                            <input disabled value="{{ $patient->OS_AUTO }}" type="text"
                                                class="form-control" name="OS_AUTO" placeholder="">

                                        </div>
                                    </div>
                                </div>
                                {{-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - --}}
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="OS_BCVA_FAR">OS BCVA FAR</label>
                                            <input disabled value="{{ $patient->OS_BCVA_FAR }}" type="text"
                                                class="form-control" name="OS_BCVA_FAR" placeholder="">

                                        </div>
                                    </div>
                                </div>
                                {{-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - --}}
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="OS_NEAR">OS NEAR</label>
                                            <input disabled value="{{ $patient->OS_NEAR }}" type="text"
                                                class="form-control" name="OS_NEAR" placeholder="">

                                        </div>
                                    </div>
                                </div>
                                {{-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - --}}
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="OS_AUTO_AFTER_CYCLO">OS AUTO AFTER CYCLO</label>
                                            <input disabled value="{{ $patient->OS_AUTO_AFTER_CYCLO }}" type="text"
                                                class="form-control" name="OS_AUTO_AFTER_CYCLO" placeholder="">

                                        </div>
                                    </div>
                                </div>
                                {{-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - --}}
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="OS_BUT">OS BUT</label>
                                            <input disabled value="{{ $patient->OS_BUT }}" type="text"
                                                class="form-control" name="OS_BUT" placeholder="">

                                        </div>
                                    </div>
                                </div>
                                {{-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - --}}
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="OS_IOP">OS IOP</label>
                                            <input disabled value="{{ $patient->OS_IOP }}" type="text"
                                                class="form-control" name="OS_IOP" placeholder="">

                                        </div>
                                    </div>
                                </div>
                                {{-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - --}}

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="OS_LIDS">OS LIDS</label>
                                            <input disabled value="{{ $patient->OS_LIDS }}" type="text"
                                                class="form-control" name="OS_LIDS" placeholder="">

                                        </div>
                                    </div>
                                </div>
                                {{-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - --}}
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="OS_CORNEA">OS CORNEA</label>
                                            <input disabled value="{{ $patient->OS_CORNEA }}" type="text"
                                                class="form-control" name="OS_CORNEA" placeholder="">

                                        </div>
                                    </div>
                                </div>
                                {{-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - --}}
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="OS_CONJUNCTIVA">OS CONJUNCTIVA</label>
                                            <input disabled value="{{ $patient->OS_CONJUNCTIVA }}" type="text"
                                                class="form-control" name="OS_CONJUNCTIVA" placeholder="">

                                        </div>
                                    </div>
                                </div>
                                {{-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - --}}
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="OS_IRIS">OS IRIS</label>
                                            <input disabled value="{{ $patient->OS_IRIS }}" type="text"
                                                class="form-control" name="OS_IRIS" placeholder="">

                                        </div>
                                    </div>
                                </div>
                                {{-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - --}}
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="OS_AC">OS AC</label>
                                            <input disabled value="{{ $patient->OS_AC }}" type="text"
                                                class="form-control" name="OS_AC" placeholder="">

                                        </div>
                                    </div>
                                </div>
                                {{-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - --}}
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="OS_LENS">OS LENS</label>
                                            <input disabled value="{{ $patient->OS_LENS }}" type="text"
                                                class="form-control" name="OS_LENS" placeholder="">

                                        </div>
                                    </div>
                                </div>
                                {{-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - --}}
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="OS_VITREOUS">OS VITREOUS</label>
                                            <input disabled value="{{ $patient->OS_VITREOUS }}" type="text"
                                                class="form-control" name="OS_VITREOUS" placeholder="">

                                        </div>
                                    </div>
                                </div>
                                {{-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - --}}
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="OS_CD">OS CD</label>
                                            <input disabled value="{{ $patient->OS_CD }}" type="text"
                                                class="form-control" name="OS_CD" placeholder="">

                                        </div>
                                    </div>
                                </div>
                                {{-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - --}}
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="OS_FUNDUS">OS FUNDUS</label>
                                            <input disabled value="{{ $patient->OS_FUNDUS }}" type="text"
                                                class="form-control" name="OS_FUNDUS" placeholder="">

                                        </div>
                                    </div>
                                </div>
                                {{-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - --}}

                            </div>

                        </div>


                    </div>
                </div>

            </div>

        </div>


        <div class="modal fade" id="paymentsModal" tabindex="-1" role="dialog" aria-labelledby="paymentsModal"
            aria-hidden="true">
            <div class="modal-xl modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">{{ __('lang.payment')  }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    
                        <div class="row text-center" style="border-color: black;border-bottom: 5px">
                            <div class="col-3">Total Paid</div>
                            <div class="col-3">Payment Type</div>
                            <div class="col-3">Payment Currency</div>
                            <div class="col-3">Paid at</div>
                        </div>
                        <ul style="padding-right:0" class="text-center list-group list-group-flush border-0">
                        @forelse($patientPayments[0]->payment as $pay)

                        <li class="list-group-item"><div class="row">
                            <div class="col-3">{{$pay->payment}}</div>
                            <div class="col-3">{{$pay->type}}</div>
                            <div class="col-3">@if(filled($pay->payment_currency)) {{ $pay->payment_currency }} @endif</div>
                            <div class="col-3">{{ $pay->created_at }}</div>
                        </div>
                    </li>


                        @empty
                        Nothing
                       @endforelse
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function htmlDecode(input) {
            var doc = new DOMParser().parseFromString(input, "text/html");
            return doc.documentElement.textContent;
        }

        function showEyeDetailFields() {
            var x = document.getElementById("EyeDetail");
            var y = document.getElementById("btnToggleEyeDetails");

            if (x.style.display === "none") {
                y.innerText = "{{ __('lang.hideDetails') }}";
                x.style.display = "block";
            } else {
                y.innerText = "{!! __('lang.showMoreDetails') !!}";
                x.style.display = "none";
            }
        }
    </script>
@endsection
