<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <form id="ajaxgo1" autocomplete="off" action="{{ route('patient.index') }}" method="POST">
                @csrf
                <div @if (App::getlocale() == 'ar') style="direction: rtl !important" @endif class="row">
                    <div class="col-lg-6  col-md-12 text-center">
                        <div class="card border-top-primary">
                            <div id="col1" class="card-body">

                                <div class="form-group">
                                    <label for="firstname">{{ __('lang.inpFN') }}</label>
                                    <input type="text" value="{{ old('firstname') }}" class="form-control"
                                        name="firstname" placeholder="{{ __('lang.inEnterFN') }}">
                                    <span class="text-danger error-text firstname_err"></span>

                                </div>




                                <div class="form-group">
                                    <label for="midname">{{ __('lang.inpMN') }}</label>
                                    <input type="text" value="{{ old('midname') }}" class="form-control"
                                        name="midname" placeholder="{{ __('lang.inEnterMN') }}">
                                    <span class="text-danger error-text midname_err"></span>

                                </div>





                                <div class="form-group">
                                    <label for="lastname">{{ __('lang.inpLN') }}</label>
                                    <input type="text" value="{{ old('lastname') }}" class="form-control"
                                        name="lastname" placeholder="{{ __('lang.inEnterLN') }}">
                                    <span class="text-danger error-text lastname_err"></span>

                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="gender">{{ __('lang.inpGender') }}</label>
                                            <select class="form-control border" name="gender">
                                                <option value="male">{{ __('lang.genderOptionMale') }}</option>
                                                <option value="female">{{ __('lang.genderOptionFemale') }}</option>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="insurancetype">{{ __('lang.inpInsuranceType') }}</label>
                                            <select class="form-control border" name="insurancetype">
                                                <option value="" selected hidden>
                                                    {{ __('lang.inpInsuranceTypeLabel') }}
                                                </option>
                                                <option value="NSSF">{{ __('lang.InsuranceTypeOpt1') }}</option>
                                                <option value="Hay2a">{{ __('lang.InsuranceTypeOpt2') }}</option>
                                                <option value="ISF">{{ __('lang.InsuranceTypeOpt3') }}</option>
                                                <option value="Lebanese army">{{ __('lang.InsuranceTypeOpt4') }}
                                                </option>
                                                <option value="Coop">{{ __('lang.InsuranceTypeOpt5') }}</option>
                                                <option value="Private">{{ __('lang.InsuranceTypeOpt6') }}</option>

                                            </select>
                                            <span class="text-danger error-text insurancetype_err"></span>

                                        </div>


                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="bloodtype">{{ __('lang.inpBloodType') }}</label>
                                            <select class="form-control border" name="bloodtype">
                                                <option value="" selected hidden>
                                                    {{ __('lang.inpBloodTypeLabel') }}
                                                </option>
                                                <option value="A+">A+</option>
                                                <option value="B+">B+</option>
                                                <option value="AB+">AB+</option>
                                                <option value="O+">O+</option>
                                                <option value="A-">A-</option>
                                                <option value="B-">B-</option>
                                                <option value="AB-">AB-</option>
                                                <option value="O-">O-</option>

                                            </select>
                                            <span class="text-danger error-text bloodtype_err"></span>

                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-12">
                                        <div style="direction: ltr !important" class="form-group">

                                            <label for="dob">{{ __('lang.InpDob') }} </label>
                                            <input type="date" class="form-control" name="dob" />

                                            <span class="text-danger error-text dob_err"></span>


                                        </div>

                                    </div>



                                </div>



                            </div>

                        </div>
                    </div>


                    {{-- Second Column Here col2 --}}


                    <div class="col-lg-6  col-md-12 marginTopResponsive text-center">
                        <div class="card border-top-success">
                            <div id="col2" class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="diag">{{ __('lang.InpDiag') }}</label>
                                            <textarea rows="2" class="form-control" name="diag" placeholder="{{ __('lang.InpDiagPlaceHolder') }}">{{ old('diag') }}</textarea>
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
                                            <input type="text" value="{{ old('firstname') }}"
                                                class="form-control" name="job"
                                                placeholder="{{ __('lang.inpJobPlaceHolder') }}">

                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="address">{{ __('lang.InpAddress') }}</label>
                                            <textarea rows="1" class="form-control" name="address"
                                                placeholder="{{ __('lang.InpAddressPlaceHolder') }}">{{ old('address') }}</textarea>
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
                                            <input type="text" value="{{ old('number') }}" class="form-control"
                                                name="number" placeholder="{{ __('lang.inpNumberPlaceHolder') }}">

                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="maincomplaint">{{ __('lang.InpMainComplaint') }}</label>
                                            <textarea rows="1" class="form-control" name="maincomplaint"
                                                placeholder="{{ __('lang.InpMainComplaintPlaceHolder') }}">{{ old('maincomplaint') }}</textarea>
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





        </div>
    </div>
</div>


<footer style="margin-bottom: 5px" class="footer footer-light footer-shadow">
    <div class="col">
        <div class="row py-2 justify-content-center">
            <div class="col-lg-12 col-md-12">
                <div class="card border-bottom-info shadow">
                    <div class="card-body justify-content-center text-center">
                       
                            <div class="row">
                                <div class="col-6"> <button class="btn btn-block btn-success" onclick="AddPatient()"
                                        type="button">{{ __('lang.addPatient') }}</button></div>
                                <div class="col-6"> <button class="btn btn-block btn-success" onclick="AddPatientwithAppointment()"
                                        type="button">{{ __('lang.addPatientWithAppointment') }}</button></div>
                            </div class="row">
                        </div>


                    </div>

                </div>
            </div>

        </div>
    </div>
</footer>
</form>
<script>
    $(window).on("load", function() {
        var col2 = document.getElementById('col2').clientHeight;
        var col1 = document.getElementById('col1').clientHeight;
        if (col2 > col1)
            document.getElementById("col1").style.height = "" + col2 + "px";
        else
            document.getElementById("col2").style.height = "" + col1 + "px";
    });





    $("#col2").click(function() {
        var col2 = document.getElementById('col2').clientHeight;

        document.getElementById("col1").style.height = "" + col2 + "px";
    });

    function showEyeDetailFields() {
        var x = document.getElementById("EyeDetail");
        var y = document.getElementById("btnToggleEyeDetails");

        if (x.style.display === "none") {
            y.innerHTML = "{{ __('lang.hideDetails') }}";
            x.style.display = "block";
        } else {
            y.innerHTML = "{{ __('lang.addMoreDetails') }}";
            x.style.display = "none";
        }
    }

    @if (Session::has('success'))
        $(function() {
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-bottom-right"
            }
            toastr.options.rtl = true;
            toastr.success("{{ Session::get('success') }}");
        })
    @endif
    @if (Session::has('failed'))
        $(function() {
            toastr.options {
                "positionClass": "toast-bottom-right"
            };
            toastr.danger("{{ Session::get('failed') }}");
        })
    @endif


    // JavaScript function to add patient from ajax form with live validation
    function AddPatient(withAppointment) {

        let firstname = $("input[name=firstname]").val();
        let midname = $("input[name=midname]").val();
        let lastname = $("input[name=lastname]").val();
        let gender = $("select[name=gender]").val();
        let insurancetype = $("select[name=insurancetype]").val();
        let bloodtype = $("select[name=bloodtype]").val();
        let dob = $("input[name=dob]").val();
        let job = $("input[name=job]").val();
        let diag = $("textarea[name=diag]").val();
        let _token = $('meta[name="csrf-token"]').attr('content');
        let address = $("textarea[name=address]").val();
        let number = $("input[name=number]").val();
        let maincomplaint = $("textarea[name=maincomplaint]").val();

        $.ajax({
            url: "/patient",
            type: "post",

            data: {
                firstname: firstname,
                midname: midname,
                lastname: lastname,
                gender: gender,
                insurancetype: insurancetype,
                dob: dob,
                bloodtype: bloodtype,
                job: job,
                diag: diag,
                address: address,
                number: number,
                maincomplaint: maincomplaint,
                _token: _token,


            },
            success: function(response) {
                location.reload();
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true,
                    "positionClass": "toast-bottom-right"
                }
                toastr.success("Added successfully");
                $('#ajaxgo1')[0].reset();

            },
            error: function(response) {
                $('.firstname_err').text(response.responseJSON.errors.firstname);
                $('.midname_err').text(response.responseJSON.errors.midname);
                $('.lastname_err').text(response.responseJSON.errors.lastname);
                $('.gender_err').text(response.responseJSON.errors.gender);
                $('.bloodtype_err').text(response.responseJSON.errors.bloodtype);
                $('.dob_err').text(response.responseJSON.errors.dob);
                $('.insurancetype_err').text(response.responseJSON.errors.insurancetype);
            }
        });
    }
    function AddPatientwithAppointment() {

let firstname = $("input[name=firstname]").val();
let midname = $("input[name=midname]").val();
let lastname = $("input[name=lastname]").val();
let gender = $("select[name=gender]").val();
let insurancetype = $("select[name=insurancetype]").val();
let bloodtype = $("select[name=bloodtype]").val();
let dob = $("input[name=dob]").val();
let job = $("input[name=job]").val();
let diag = $("textarea[name=diag]").val();
let _token = $('meta[name="csrf-token"]').attr('content');
let address = $("textarea[name=address]").val();
let number = $("input[name=number]").val();
let maincomplaint = $("textarea[name=maincomplaint]").val();
let withAppointment = true;

$.ajax({
    url: "/patient",
    type: "post",

    data: {
        firstname: firstname,
        midname: midname,
        lastname: lastname,
        gender: gender,
        insurancetype: insurancetype,
        dob: dob,
        bloodtype: bloodtype,
        job: job,
        diag: diag,
        address: address,
        number: number,
        maincomplaint: maincomplaint,
        withAppointment: true,
        _token: _token,


    },
    success: function(response) {
        location.reload();
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-bottom-right"
        }
        toastr.success("Added successfully");
        $('#ajaxgo1')[0].reset();

    },
    error: function(response) {
        $('.firstname_err').text(response.responseJSON.errors.firstname);
        $('.midname_err').text(response.responseJSON.errors.midname);
        $('.lastname_err').text(response.responseJSON.errors.lastname);
        $('.gender_err').text(response.responseJSON.errors.gender);
        $('.bloodtype_err').text(response.responseJSON.errors.bloodtype);
        $('.dob_err').text(response.responseJSON.errors.dob);
        $('.insurancetype_err').text(response.responseJSON.errors.insurancetype);
    }
});
}


    jQuery(document).ready(function() {
        // event for click on input (also you can use click)
        //better to change form to .yourFormClass
        $('form input[type=text]').focus(function() {
            // get selected input error container
            $(this).siblings("#error").remove();
        });
    });
    jQuery(document).ready(function() {
        // event for click on input (also you can use click)
        //better to change form to .yourFormClass
        $('form input[type=date]').focus(function() {
            // get selected input error container
            $(this).siblings("#error").remove();
        });
    });
    jQuery(document).ready(function() {
        // event for click on input (also you can use click)
        //better to change form to .yourFormClass
        $('form form-group select').focus(function() {
            // get selected input error container
            $(this).siblings("#error").remove();
        });
    });
</script>
