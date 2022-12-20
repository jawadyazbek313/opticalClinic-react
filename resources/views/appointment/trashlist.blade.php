@extends('layouts.app')
@section('content')
<div id="content" class="container-fluid text-center justify-content-center">
  @include('appointment.trashlistAjax')

</div>
<script>
  $(".card-body").css('padding',0);
$( ".pagination" ).addClass( "row justify-content-center text-center ltr" );


function restoreMe(id){
let _token   = $('meta[name="csrf-token"]').attr('content');
$.ajax({
    url:"/appointment/"+id+"/restore",
    type: "GET",
    
    success:function(response)
     {

      toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true,
    "positionClass": "toast-bottom-center"
  }
       toastr.success(response['success']);
       $.ajax({
     url:"/appointments/trashlistrefresh",
     success:function(data)
     {
     
      
      $('#content').html(data);
      
    

     }
    });
    
       
      
      
    
}

});
}
function deleteMe(id){
    let _token   = $('meta[name="csrf-token"]').attr('content');
$.ajax({
    url:"/appointment/"+id,
    type: "DELETE",
    data:{
        _token:_token,
        id:id
    },
    success:function(response)
     {
        toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true,
    "positionClass": "toast-bottom-center"
  }
       toastr.success(response['success']);
       
       $.ajax({
     url:"/appointments/trashlistrefresh",
     success:function(data)
     {
     
      
      $('#content').html(data);
      
    

     }
    });
       
      
      
    
}

});

}

</script>
@endsection