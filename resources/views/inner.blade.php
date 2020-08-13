@foreach($row as $r)

@if($sid==$r->sender_id)
<p style="width: 60%; background-color: dodgerblue; border-radius: 30px; float: right; padding: 10px; padding-left: 5px; color: white">{{$r->msg}}</p>
@endif

@if($sid!=$r->sender_id)
<p style="width: 60%; background-color: slategray; border-radius: 30px; float: left; padding: 10px ; color: white">{{$r->msg}}</p>
@endif



@endforeach