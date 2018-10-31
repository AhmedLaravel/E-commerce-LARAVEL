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
              {!! Form::open(['url' => aurl('subscribe/email/subscribers'), 'method'=>"POST"]) !!}
              {!! Form::textarea('mail',old('mail'),['class'=>'form form-control','placeholder'=>trans('admin.type_mail')]) !!}
              {!! Form::submit(trans('admin.send'),['class'=>'btn btn-primary']) !!}             
              {!! Form::close() !!}             
            </div> 
          </div>
        </div>
      </div>
    </section>

@endsection