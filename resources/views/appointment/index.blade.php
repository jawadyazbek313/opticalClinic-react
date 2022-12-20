@extends('layouts.app')
@section('content')

<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div @if (app()->getlocale()=='ar') style="direction:rtl" @endif  class="card border-left-info shadow">
        <div class="card-body text-center p-0">
          <div class="card-header">
            <div class="row">
              <div class="col-lg-1 col-md-4 col-sm-4 col-xs-4">ID</div>
              <div class="col-lg-3 col-md-4 col-sm-8 col-xs-8">{{__('lang.patientName')}}</div>
              <div class="col-lg-3 col-md-4 col-sm-12">{{__('lang.appointmentDate')}}</div>
              <div class="col-lg-2 col-md-12">{{__('lang.InpAppointmentNotes')}}</div>
              <div class="col-lg-1 col-md-12">{{__('lang.isDone')}}</div>
              <div class="col-lg-2 col-md-12">الخيارات</div>
            
            </div>
          </div>

          <ul style="padding-right:0" class="list-group list-group-flush border">
            @foreach ($appointments as $appointment)

            <li class="list-group-item">
              <div class="row">
                <div style="display: table; overflow: hidden;" class="col-lg-1 col-md-4 col-sm-4 col-xs-4">
                  <div style="display: table-cell; vertical-align: middle;">
                    {{$appointment->id}} </div>
                </div>

                <div style="display: table; overflow: hidden;" class="col-lg-3 col-md-4 col-sm-8 col-xs-8">
                  <div style="display: table-cell; vertical-align: middle;"> <h5><a
                      href="{{ route('patient.show',$appointment->patient[0]->id ) }}">{{$appointment->patient[0]->firstname.' '.$appointment->patient[0]->midname.' '.$appointment->patient[0]->lastname}}</a></h5>
                  </div>
                </div>
                <div style="display: table; overflow: hidden;" class="col-lg-3 col-md-4 col-sm-12">
                  <div style="display: table-cell; vertical-align: middle;">
                    <h5> {{$appointment->date.' | '.$appointment->time}}</h5>
                  </div>
                </div>
                <div style="display: table; overflow: hidden;" class="col-lg-2 col-md-12">
                  <div style="direction: rtl !important; display: table-cell; vertical-align: middle;">
                    {{ \Illuminate\Support\Str::limit($appointment->notes,25, $end='...')}}
                  </div>
                </div>

                <div style="display: table; overflow: hidden;" class="col-lg-1 col-md-12">
                  <div style="direction: rtl !important; display: table-cell; vertical-align: middle;">
                    @if ($appointment->isDone==1)
                    <div data-toggle="tooltip" data-placement="bottom" data-html="true"
                      title='<div  class="row "><div class="col"><h4>Paid</h4></div></div> <div class="row"><div class="col">
                        <h5>{{$appointment->payment[0]->payment}} @if ($appointment->payment[0]->payment_type=='cash') 
                          {{ ($appointment->payment[0]->payment_currency=="us") ? '<small>$$</small>' : '<small>L.L.</small>' }} @endif</h5>  <br>
                      {{$appointment->payment[0]->created_at}}</div>
                  </div>' class="card text-white bg-success text-center justify-content-center mb-0 my-0">


                  {{ __('lang.Done') }}

                </div>
                @else
                <div id="ChangeAfterSuccess" data-patient_id="{{$appointment->patient[0]->id}}"
                  data-appointment_id="{{$appointment->id}}"
                  class="OpenModal btn btn-sm btn-block  btn-outline-primary text-center justify-content-center mb-0 my-0 success-change"
                  type="button">{{ __('lang.MarkDone') }}</div>
                @endif
              </div>
        </div>
{{-- 
        ModalShowAppointmentDetails --}}



        <div class="col-lg-2 col-md-12 marginTopResponsive">
          <div style="direction: ltr" class="btn-group text-center justify-content-center">
            <a type="button" data-appointment_id="{{$appointment->id}}" class="btn btn-outline-primary showDeatialsModal"> <i class="fas fa-eye fa-lg "></i> </a>
            <a type="button" href="{{ route('appointment.edit', $appointment->id) }}" class="btn btn-outline-success"> <i class="far fa-edit fa-lg "></i></a>
            <a type="button" data-appointmentid="{{$appointment->id}}" class="btn btnAbort btn-outline-danger"><i class="far fa-trash-alt fa-lg"></i></a></div>
        </div>






        </li>
        @endforeach</ul>

      
      <div style="direction: ltr; " class="card">

        <div style="margin-top: 10px" class="row justify-content-center">
          {{ $appointments->links()}}</div>

      </div>
    </div>


    <div @if (app()->getlocale()=='ar')
      style="direction:rtl"
      @endif class="modal fade " id="myModal" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"
      style="display: none;">
      <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
            <button type="button" class="btn @if (app()->getlocale()=='ar') float-left @else float-right @endif "
              data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="ajaxform">
              <div class="row">
                <div class="col-lg-6 col-md-12">
                  <input hidden name="patient_id" value="">
                  <input hidden name="appointment_id" value="">

                  <div class="form-group">
                    <label for="payment_type">{{__('lang.choosePaymentType')}}</label>
                    <select required minlength="1" class="form-control selectpicker" name="payment_type" id="payment_type">
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
                        <input minlength="4"  disabled type="payment" value="{{old ('payment') }}" class="form-control" name="payment"
                          id="payment" placeholder="{{__('lang.inpPaymentPlaceHolder')}}" required>

                      </div>
                    </div>
                    <div id="Currency" style="display: none" class="col-4">
                      <div class="form-group">
                        <label for="payment_currency">{{__('lang.choosePaymentCurrency')}}</label>
                        <select class="form-control selectpicker" name="payment_currency" id="payment_currency">
                          <option selected hidden value=""></option>
                          <option value="lbp">{{__('lang.lbp')}}</option>
                          <option value="us">{{__('lang.us')}}</option>

                        </select>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">

            <button type="button" class="btn btn-secondary" onclick="Resetform()" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary save-data">Save changes</button>
          </div>
        </div>
      </div>
    </div>


  </div>

  <div  class="modal fade " id="appModal" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          
          <button type="button" class="btn @if (app()->getlocale()=='ar') float-left @else float-right @endif "
            data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div id="ModalShowAppointmentDetails" class="modal-body">
          
        </div>
        <div class="modal-footer">
  
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary save-data">Save changes</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-body text-center">
        <h2> {{ __('lang.AreYouSureToDelete') }}</h2>
        <h6><span class="badge-warning badge-pill card p-2"><i class="fas fa-exclamation-triangle"></i>
            {{ __('lang.warnDelete') }}</span></h6>
        <div class="row pt-4">
          <input hidden type="text" name="appointmentidtrash" id="">
          <div class="col-6">
            <a class="btn btn-block btn-info text-white btn-ok MoveToTrash"><i class="fas fa-recycle"></i>
              {{ __('lang.MoveToTrash') }}</a>

          </div>
          <div class="col-6">
            <a class="btn btn-block btn-danger btn-ok DeletePermanently"><i class="fas fa-trash"></i>
              {{ __('lang.DeletePermanently') }}</a></div>

        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-light text-dark  btn-default btn-block"
          data-dismiss="modal">Cancel</button>

      </div>
    </div>
  </div>
</div>

  <script>
    $(".MoveToTrash").click(function(event){
let appointment_id=$('input[name=appointmentidtrash]').val();
let _token   = $('meta[name="csrf-token"]').attr('content');
let type="temp";
    $.ajax({
     url:"appointment/trash",
     type:"post",
      
        data:{
          appointment_id:appointment_id,
          type:type,
          _token: _token
        },
     success:function(response)
     {
       toastr.success(response['success']);
        $("#confirm-delete").modal('hide');
       location.reload();
       
      
      
    
}
     });



});


$(".DeletePermanently").click(function(event){
let appointment_id=$('input[name=appointmentidtrash]').val();
deleteAppointment(appointment_id);


});
    $("#appointment-table").addClass("table-hover").addClass("table-bordered").addClass("text-center");
  $(".OpenModal").click(function(event){
    
    $('#myModal').modal('show');
    var pat_id=$(this).attr('data-patient_id');
    var app_id=$(this).attr('data-appointment_id');
    $("input[name=patient_id]").val(pat_id);
    $("input[name=appointment_id]").val(app_id);
    
});


$(".showEditModal").click(function(event){
  event.preventDefault();
    var id=$(this).attr('data-appointment_id');
    fetch_AppEdit(id);
    
    
});
$(".showDeatialsModal").click(function(event){
  event.preventDefault();
    var id=$(this).attr('data-appointment_id');
    fetch_AppDetails(id);
    
    
});
function Resetform(){

  $("#ajaxform")[0].reset();
}

$(".save-data").click(function(event){
      event.preventDefault();

      let payment_type = $("select[name=payment_type]").val();
      let payment_currency = $("select[name=payment_currency]").val();
      let payment = $("input[name=payment]").val();
      let patient_id = $("input[name=patient_id]").val();
      let _token   = $('meta[name="csrf-token"]').attr('content');
      let appointment_id = $("input[name=appointment_id]").val();
      

      $.ajax({
        url: "/appointment/"+appointment_id+"/MarkDone",
        type:"post",
        beforeSend: function(){
          this.innerHTML=' <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="sr-only">Loading...</span>';
    },
    complete: function(){
      this.innerHTML='Save';
    },
        data:{
          payment_type:payment_type,
          payment_currency:payment_currency,
          payment:payment,
          patient_id:patient_id,
          _token: _token
        },
        success:function(response){
      
          if(response) {
            toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true,
    "positionClass": "toast-top-right"
  }
            toastr.success(response['success']);
            $('#myModal').modal('hide');
            $("#ajaxform")[0].reset();
            console.log(response['payment']);
            $('#ChangeAfterSuccess').html('Done').removeClass('bg-primary').addClass('bg-success')
            .removeClass('OpenModal').attr("data-toggle","tooltip").attr("data-placement","bottom").attr("data-html",true)
            .removeAttr("type").attr("data-original-title",'<div  class="row "><div class="col">Paid</div></div> <div class="row"><div class="col">'+response['payment']+' <br> '+response['created_at']+'</div></div>');
            $('[data-toggle="tooltip"]').tooltip();
          }
        },
        fail:function(){
          toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true,
    "positionClass": "toast-bottom-right"
  }
          toastr.danger("Failed to Update");
        }
       }
       );
  });
  
  document.getElementById('payment_type').addEventListener('change', function() {
    var x= document.getElementById('payment');
    if(this.value!=null) x.disabled = false;
    if(this.value!='cash') {x.value=""; x.type='text'; if(document.getElementById('Currency').style.display=="block") {document.getElementById('Currency').style.display="none";}}
    else  {x.value=""; x.type='number'; document.getElementById('Currency').style.display="block";}
});
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});


function fetch_AppDetails(id)
   {
    $.ajax({
     url:"/appointment/"+id,
     success:function(data)
     {
     
      
      $('#ModalShowAppointmentDetails').html(data);
      
    
    $('#appModal').modal('show');

     }
    });
   }
   function fetch_AppEdit(id)
   {
    $.ajax({
     url:"/appointment/"+id+"/edit",
     success:function(data)
     {
     
      
      $('#ModalShowAppointmentDetails').html(data);
      
    
    $('#appModal').modal('show');
     }
    });
   }


   $(".btnAbort").click(function(event){
    
    let appointment_id=$(this).attr('data-appointmentid');
    $('input[name=appointmentidtrash]').val(appointment_id);

    $("#confirm-delete").modal('show');



  });
  </script>
  @endsection