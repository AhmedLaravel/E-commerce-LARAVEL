@extends('style.index')
@section('content')
<br>
<br>
<br>
<!-- start banner -->
		<center>	
			{{Form::open(['url'=>url('user/signup')])}}
              <div class="form-group">
                {{Form::label('Name', trans('admin.user_name'))}}  
                {{Form::text('name',old('name'),['class'=>'form-control', 'placeholder'=>trans('admin.user_name')])}}  
              </div>
              <div class="form-group">
                {{Form::label('Email', trans('admin.user_email'))}}  
                {{Form::email('email',old('email'),['class'=>'form-control','placeholder'=>trans('admin.user_email')])}}  
              </div>
              <div class="form-group">
                {{Form::label('Password', trans('admin.pass'))}}  
                {{Form::password('password', ['placeholder'=>trans('admin.write_password'),'class'=>'form-control'])}}  
              </div>
              <div class="form-group">
                {{Form::label('Pass_confirm', trans('admin.pass_confirm'))}}  
                {{Form::password('password_confirmation',['placeholder'=>trans('admin.write_pass_holder'),'class'=>'form-control'])}}  
              </div>
          	{{Form::submit(trans('admin.add_user'),['class'=>'btn btn-primary'])}}
          	{{Form::close()}}
          	<br>
          	<br>
          	<br>
		</center>
<!-- special -->

@endsection