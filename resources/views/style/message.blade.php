@if($errors->all())
	@foreach($errors->all() as $error)
		<div class="alert alert-danger"><h3>{{$error}}</h3></div>
	@endforeach
@endif
 @if(session()->has('message'))
     <h2 class="alert alert-success">{{session()->get('message')}}</h2>
@endif
@if(session()->has('userMessage'))
     <h2 class="alert alert-success">{{session()->get('userMessage')}}</h2>
     {{session()->forget('userMessage')}}
@endif
