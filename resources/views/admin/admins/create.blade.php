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
              {{Form::open(['url'=>aurl('admin')])}}
              <div class="form-group">
                {{Form::label('Name', trans('admin.name'))}}  
                {{Form::text('name',old('name'),['class'=>'form-control', 'placeholder'=>trans('admin.name')])}}  
              </div>
              <div class="form-group">
                {{Form::label('Email', trans('admin.email'))}}  
                {{Form::email('email',old('email'),['class'=>'form-control','placeholder'=>trans('admin.email')])}}  
              </div>
              <div class="form-group">
                {{Form::label('Password', trans('admin.pass'))}}  
                {{Form::password('password', ['placeholder'=>trans('admin.write_password'),'class'=>'form-control'])}}  
              </div>
              <div class="form-group">
                {{Form::label('Pass_confirm', trans('admin.pass_confirm'))}}  
                {{Form::password('password_confirmation',['placeholder'=>trans('admin.write_pass_holder'),'class'=>'form-control'])}}  
              </div>
              {{Form::submit(trans('admin.add_admin'),['class'=>'btn btn-primary'])}}
              {{Form::close()}}
            </div> 
          </div>
        </div>
      </div>
    </section>

<!-- Modal -->

@endsection