<form action="{{ route('appointment.index')."/".$row->id."/markAsDone"}}" method="method">
@csrf
@method('put')
<button type="submit" class="btn btn-block btn-success">{{__('lang.markAsDone')}}</button>
</form>