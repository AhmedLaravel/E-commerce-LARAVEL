@extends('admin.index')
@section('content')
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">{{$title}}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              {{Form::open(['url'=>aurl('users/'.$user->id), 'method' => 'PUT'])}}
              <div class="form-group">
                {{Form::label('Name', trans('admin.user_name'))}}  
                {{Form::text('name',$user->name,['class'=>'form-control', 'placeholder'=>trans('admin.user_name')])}}  
              </div>
              <div class="form-group">
                {{Form::label('Email', trans('admin.user_email'))}}  
                {{Form::email('email',$user->email,['class'=>'form-control','placeholder'=>trans('admin.user_email')])}}  
              </div>
              <div class="form-group">
                {{Form::label('Password', trans('admin.pass'))}}  
                {{Form::password('password', ['placeholder'=>trans('admin.write_password'),'class'=>'form-control'])}}  
              </div>
              <div class="form-group">
                {{Form::label('Pass_confirm', trans('admin.pass_confirm'))}}  
                {{Form::password('password_confirmation',['placeholder'=>trans('admin.write_pass_holder'),'class'=>'form-control'])}}  
              </div>
              {{Form::submit(trans('admin.edit_user'),['class'=>'btn btn-primary'])}}
              {{Form::close()}}
            </div> 
          </div>
        </div>
      </div>
    </section>

<!-- Modal -->

@endsection