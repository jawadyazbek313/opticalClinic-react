@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="row justify-content-center text-center pb-2 pt-0">
                    <div class="col">
                        <div class="shadow py-2 card border-top-success">
                            <h4>تعديل الملف</h4>
                        </div>
                    </div>
                </div>
                <form action="{{ route('patient.update', $patient->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div @if (App::getlocale() == 'ar') style="direction: rtl !important" @endif class="row">
                        <div class="col-lg-6 mb-4 col-md-12 text-center">
                            <div class="card h-100 border-top-success">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="firstname">{{ __('lang.inpFN') }}</label>
                                        <input value="{{ $patient->firstname }}" type="text" class="form-control"
                                            name="firstname">

                                    </div>




                                    <div class="form-group">
                                        <label for="midname">{{ __('lang.inpMN') }}</label>
                                        <input value="{{ $patient->midname }}" type="text" class="form-control"
                                            name="midname">

                                    </div>





                                    <div class="form-group">
                                        <label for="lastname">{{ __('lang.inpLN') }}</label>
                                        <input value="{{ $patient->lastname }}" type="text" class="form-control"
                                            name="lastname">

                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label for="gender">{{ __('lang.inpGender') }}</label>
                                                <select id="genderSelect" class="selectpicker form-control" name="gender">
                                                    <option {{ $patient->gender == 'male' ? "selected" : '' }} value="male">{{ __('lang.genderOptionMale') }}</option>
                                                    <option {{ $patient->gender == 'female' ? "selected" : '' }} value="female">{{ __('lang.genderOptionFemale') }}</option>

                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label for="insurancetype">{{ __('lang.inpInsuranceType') }}</label>
                                                <select id="InsuranceSelect" class="selectpicker form-control"
                                                    name="insurancetype">
                                                    <option {{ $patient->insurance == 'NSSF' ? "selected" : '' }}
                                                        value="NSSF">{{ __('lang.InsuranceTypeOpt1') }}</option>
                                                    <option {{ $patient->insurance == 'Hay2a' ? "selected" : '' }}
                                                        value="Hay2a">{{ __('lang.InsuranceTypeOpt2') }}</option>
                                                    <option {{ $patient->insurance == 'ISF' ? "selected" : '' }}
                                                        value="ISF">{{ __('lang.InsuranceTypeOpt3') }}</option>
                                                    <option
                                                        {{ $patient->insurance == 'Lebanese army' ? "selected" : '' }}
                                                        value="Lebanese army">{{ __('lang.InsuranceTypeOpt4') }}
                                                    </option>
                                                    <option {{ $patient->insurance == 'Coop' ? "selected" : '' }}
                                                        value="Coop">{{ __('lang.InsuranceTypeOpt5') }}</option>
                                                    <option {{ $patient->insurance == 'Private' ? "selected" : '' }}
                                                        value="Private">{{ __('lang.InsuranceTypeOpt6') }}</option>

                                                </select>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label for="bloodtype">{{ __('lang.inpBloodType') }}</label>
                                                <select id="BloodSelect" class="selectpicker form-control" name="bloodtype">
                                                    <option selected hidden>{{ __('lang.inpBloodTypeLabel') }}</option>
                                                    <option {{ $patient->bloodtype == 'A+' ? "selected" : '' }} value="A+">A+</option>
                                                    <option {{ $patient->bloodtype == 'B+' ? "selected" : '' }} value="B+">B+</option>
                                                    <option {{ $patient->bloodtype == 'AB+' ? "selected" : '' }} value="AB+">AB+</option>
                                                    <option {{ $patient->bloodtype == 'O+' ? "selected" : '' }} value="O+">O+</option>
                                                    <option {{ $patient->bloodtype == 'A-' ? "selected" : '' }} value="A-">A-</option>
                                                    <option {{ $patient->bloodtype == 'B-' ? "selected" : '' }} value="B-">B-</option>
                                                    <option {{ $patient->bloodtype == 'AB-' ? "selected" : '' }} value="AB-">AB-</option>
                                                    <option {{ $patient->bloodtype == 'O-' ? "selected" : '' }} value="O-">O-</option>

                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-12">
                                            <div style="direction: ltr !important" class="form-group">

                                                <label for="dob">{{ __('lang.InpDob') }} </label>
                                                <input id="datepicker" value="{{ $patient->dob }}" name="dob" />
                                                <script>
                                                    $('#datepicker').datepicker({
                                                        uiLibrary: 'bootstrap4',
                                                        iconsLibrary: 'materialicons',
                                                        weekStartDay: 1,
                                                        format: 'dd-mm-yyyy',
                                                        header: true
                                                    });
                                                </script>
                                                @error('dob')
                                                    <div id="error" style="direction: ltr !important;"
                                                        class="card text-white bg-danger"> <span><i
                                                                class="fas fa-exclamation-triangle"></i>
                                                            {{ $message }}</span>
                                                    </div>
                                                @enderror

                                            </div>

                                        </div>



                                    </div>



                                </div>

                            </div>
                        </div>


                        {{-- Second Column Here col2 --}}


                        <div class="col-lg-6 mb-4  col-md-12 marginTopResponsive text-center">
                            <div class="card h-100 border-top-success">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="diag">{{ __('lang.InpDiag') }}</label>
                                                <textarea rows="2" class="form-control" name="diag">{{ old('diag') }}{{ $patient->diag }}</textarea>
                                                @error('diag')
                                                    <div id="error" style="direction: ltr !important;"
                                                        class="card text-white bg-danger"><span><i
                                                                class="fas fa-exclamation-triangle"></i>
                                                            {{ $message }}</span>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="job">{{ __('lang.inpJob') }}</label>
                                                <input value="{{ $patient->job }}" type="text" class="form-control"
                                                    name="job">

                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="address">{{ __('lang.InpAddress') }}</label>
                                                <textarea rows="1" class="form-control" name="address">{{ old('address') }}{{ $patient->address }}</textarea>
                                                @error('address')
                                                    <div id="error" style="direction: ltr !important;"
                                                        class="card text-white bg-danger"><span><i
                                                                class="fas fa-exclamation-triangle"></i>
                                                            {{ $message }}</span>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="number">{{ __('lang.inpNumber') }}</label>
                                                <input value="{{ $patient->number }}" type="text" class="form-control"
                                                    name="number">

                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="maincomplaint">{{ __('lang.InpMainComplaint') }}</label>
                                                <textarea rows="1" class="form-control"
                                                    name="maincomplaint">{{ old('maincomplaint') }}{{ $patient->maincomplaint }}</textarea>
                                                @error('maincomplaint')
                                                    <div id="error" style="direction: ltr !important;"
                                                        class="card text-white bg-danger"><span><i
                                                                class="fas fa-exclamation-triangle"></i>
                                                            {{ $message }}</span>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div id="EyeDetail" class="row py-4 justify-content-center" style=" margin-bottom: 75px">
                        <div class="col-lg-12 col-md-12">
                            <div class="card text-center border-top-success">
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
                                                        <input value="{{ $patient->OD_VA }}" type="text"
                                                            class="form-control" name="OD_VA" placeholder="">

                                                    </div>
                                                </div>
                                            </div>
                                            {{-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - --}}
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="OD_AUTO">OD AUTO</label>
                                                        <input value="{{ $patient->OD_AUTO }}" type="text"
                                                            class="form-control" name="OD_AUTO" placeholder="">

                                                    </div>
                                                </div>
                                            </div>
                                            {{-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - --}}
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="OD_BCVA_FAR">OD BCVA FAR</label>
                                                        <input value="{{ $patient->OD_BCVA_FAR }}" type="text"
                                                            class="form-control" name="OD_BCVA_FAR" placeholder="">

                                                    </div>
                                                </div>
                                            </div>
                                            {{-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - --}}
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="OD_NEAR">OD NEAR</label>
                                                        <input value="{{ $patient->OD_NEAR }}" type="text"
                                                            class="form-control" name="OD_NEAR" placeholder="">

                                                    </div>
                                                </div>
                                            </div>
                                            {{-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - --}}
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="OD_AUTO_AFTER_CYCLO">OD AUTO AFTER CYCLO</label>
                                                        <input value="{{ $patient->OD_AUTO_AFTER_CYCLO }}" type="text"
                                                            class="form-control" name="OD_AUTO_AFTER_CYCLO"
                                                            placeholder="">

                                                    </div>
                                                </div>
                                            </div>
                                            {{-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - --}}
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="OD_BUT">OD BUT</label>
                                                        <input value="{{ $patient->OD_BUT }}" type="text"
                                                            class="form-control" name="OD_BUT" placeholder="">

                                                    </div>
                                                </div>
                                            </div>
                                            {{-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - --}}
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="OD_IOP">OD IOP</label>
                                                        <input value="{{ $patient->OD_IOP }}" type="text"
                                                            class="form-control" name="OD_IOP" placeholder="">

                                                    </div>
                                                </div>
                                            </div>
                                            {{-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - --}}

                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="OD_LIDS">OD LIDS</label>
                                                        <input value="{{ $patient->OD_LIDS }}" type="text"
                                                            class="form-control" name="OD_LIDS" placeholder="">

                                                    </div>
                                                </div>
                                            </div>
                                            {{-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - --}}
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="OD_CORNEA">OD CORNEA</label>
                                                        <input value="{{ $patient->OD_CORNEA }}" type="text"
                                                            class="form-control" name="OD_CORNEA" placeholder="">

                                                    </div>
                                                </div>
                                            </div>
                                            {{-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - --}}
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="OD_CONJUNCTIVA">OD CONJUNCTIVA</label>
                                                        <input value="{{ $patient->OD_CONJUNCTIVA }}" type="text"
                                                            class="form-control" name="OD_CONJUNCTIVA" placeholder="">

                                                    </div>
                                                </div>
                                            </div>
                                            {{-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - --}}
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="OD_IRIS">OD IRIS</label>
                                                        <input value="{{ $patient->OD_IRIS }}" type="text"
                                                            class="form-control" name="OD_IRIS" placeholder="">

                                                    </div>
                                                </div>
                                            </div>
                                            {{-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - --}}
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="OD_AC">OD AC</label>
                                                        <input value="{{ $patient->OD_AC }}" type="text"
                                                            class="form-control" name="OD_AC" placeholder="">

                                                    </div>
                                                </div>
                                            </div>
                                            {{-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - --}}
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="OD_LENS">OD LENS</label>
                                                        <input value="{{ $patient->OD_LENS }}" type="text"
                                                            class="form-control" name="OD_LENS" placeholder="">

                                                    </div>
                                                </div>
                                            </div>
                                            {{-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - --}}
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="OD_VITREOUS">OD VITREOUS</label>
                                                        <input value="{{ $patient->OD_VITREOUS }}" type="text"
                                                            class="form-control" name="OD_VITREOUS" placeholder="">

                                                    </div>
                                                </div>
                                            </div>
                                            {{-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - --}}
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="OD_CD">OD CD</label>
                                                        <input value="{{ $patient->OD_CD }}" type="text"
                                                            class="form-control" name="OD_CD" placeholder="">

                                                    </div>
                                                </div>
                                            </div>
                                            {{-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - --}}
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="OD_FUNDUS">OD FUNDUS</label>
                                                        <input value="{{ $patient->OD_FUNDUS }}" type="text"
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
                                                        <input value="{{ $patient->OS_VA }}" type="text"
                                                            class="form-control" name="OS_VA" placeholder="">

                                                    </div>
                                                </div>
                                            </div>
                                            {{-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - --}}
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="OS_AUTO">OS AUTO</label>
                                                        <input value="{{ $patient->OS_AUTO }}" type="text"
                                                            class="form-control" name="OS_AUTO" placeholder="">

                                                    </div>
                                                </div>
                                            </div>
                                            {{-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - --}}
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="OS_BCVA_FAR">OS BCVA FAR</label>
                                                        <input value="{{ $patient->OS_BCVA_FAR }}" type="text"
                                                            class="form-control" name="OS_BCVA_FAR" placeholder="">

                                                    </div>
                                                </div>
                                            </div>
                                            {{-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - --}}
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="OS_NEAR">OS NEAR</label>
                                                        <input value="{{ $patient->OS_NEAR }}" type="text"
                                                            class="form-control" name="OS_NEAR" placeholder="">

                                                    </div>
                                                </div>
                                            </div>
                                            {{-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - --}}
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="OS_AUTO_AFTER_CYCLO">OS AUTO AFTER CYCLO</label>
                                                        <input value="{{ $patient->OS_AUTO_AFTER_CYCLO }}" type="text"
                                                            class="form-control" name="OS_AUTO_AFTER_CYCLO"
                                                            placeholder="">

                                                    </div>
                                                </div>
                                            </div>
                                            {{-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - --}}
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="OS_BUT">OS BUT</label>
                                                        <input value="{{ $patient->OS_BUT }}" type="text"
                                                            class="form-control" name="OS_BUT" placeholder="">

                                                    </div>
                                                </div>
                                            </div>
                                            {{-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - --}}
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="OS_IOP">OS IOP</label>
                                                        <input value="{{ $patient->OS_IOP }}" type="text"
                                                            class="form-control" name="OS_IOP" placeholder="">

                                                    </div>
                                                </div>
                                            </div>
                                            {{-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - --}}

                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="OS_LIDS">OS LIDS</label>
                                                        <input value="{{ $patient->OS_LIDS }}" type="text"
                                                            class="form-control" name="OS_LIDS" placeholder="">

                                                    </div>
                                                </div>
                                            </div>
                                            {{-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - --}}
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="OS_CORNEA">OS CORNEA</label>
                                                        <input value="{{ $patient->OS_CORNEA }}" type="text"
                                                            class="form-control" name="OS_CORNEA" placeholder="">

                                                    </div>
                                                </div>
                                            </div>
                                            {{-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - --}}
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="OS_CONJUNCTIVA">OS CONJUNCTIVA</label>
                                                        <input value="{{ $patient->OS_CONJUNCTIVA }}" type="text"
                                                            class="form-control" name="OS_CONJUNCTIVA" placeholder="">

                                                    </div>
                                                </div>
                                            </div>
                                            {{-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - --}}
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="OS_IRIS">OS IRIS</label>
                                                        <input value="{{ $patient->OS_IRIS }}" type="text"
                                                            class="form-control" name="OS_IRIS" placeholder="">

                                                    </div>
                                                </div>
                                            </div>
                                            {{-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - --}}
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="OS_AC">OS AC</label>
                                                        <input value="{{ $patient->OS_AC }}" type="text"
                                                            class="form-control" name="OS_AC" placeholder="">

                                                    </div>
                                                </div>
                                            </div>
                                            {{-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - --}}
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="OS_LENS">OS LENS</label>
                                                        <input value="{{ $patient->OS_LENS }}" type="text"
                                                            class="form-control" name="OS_LENS" placeholder="">

                                                    </div>
                                                </div>
                                            </div>
                                            {{-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - --}}
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="OS_VITREOUS">OS VITREOUS</label>
                                                        <input value="{{ $patient->OS_VITREOUS }}" type="text"
                                                            class="form-control" name="OS_VITREOUS" placeholder="">

                                                    </div>
                                                </div>
                                            </div>
                                            {{-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - --}}
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="OS_CD">OS CD</label>
                                                        <input value="{{ $patient->OS_CD }}" type="text"
                                                            class="form-control" name="OS_CD" placeholder="">

                                                    </div>
                                                </div>
                                            </div>
                                            {{-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - --}}
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="OS_FUNDUS">OS FUNDUS</label>
                                                        <input value="{{ $patient->OS_FUNDUS }}" type="text"
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



            </div>
        </div>
    </div>

    <script>
        function showEyeDetailFields() {
            var x = document.getElementById("EyeDetail");
            var y = document.getElementById("btnToggleEyeDetails");

            if (x.style.display === "none") {
                y.innerText = "إخفاء التفاصيل";
                x.style.display = "block";
            } else {
                y.innerText = "إضغط هنا لإصافة تفاصيل العينين";
                x.style.display = "none";
            }
        }

        @if (Session::has('success'))
            $(function(){
            toastr.options =
            {
            "closeButton" : true,
            "progressBar" : true,
            "positionClass": "toast-top-left"
            }
            toastr.options.rtl = true;
            toastr.success("{{ Session::get('success') }}");
            })
        @endif
        @if (Session::has('failed'))
            $(function(){
            toastr.danger("{{ Session::get('failed') }}");
            })
        @endif


      
    </script>
    <footer style="margin-bottom: 5px;height: auto;" class="footer fixed-bottom footer-light footer-shadow">
        <div class="col">
            <div class="row py-1  justify-content-center">
                <div class="col-lg-12 col-md-12">
                    <div class="card border-bottom-info shadow">
                        <div class="card-body">
                            <button id="btnToggleEyeDetails" class="btn btn-primary float-left"
                                onclick="showEyeDetailFields()" type="button">{{ __('lang.showMoreDetails') }}</button>
                            <button class="btn btn-success float-right"
                                type="submit">{{ __('lang.updatePatient') }}</button>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </footer>
    </form>
@endsection
