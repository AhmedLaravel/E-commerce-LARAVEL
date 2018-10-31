
@if($level == 'user')
<span class="label label-primary"> {{$level}}</span>
@elseif($level == 'vendor')
<span class="label label-success">{{$level}}</span>
@elseif($level == 'company')
<span class="label label-info">{{$level}}</span>
@endif


