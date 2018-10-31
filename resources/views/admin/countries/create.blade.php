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
              {!!Form::open(['url'=>aurl('countries'), 'files'=>true])!!}
              <div class="form-group">
                {!! Form::label('Name_ar', trans('admin.name_ar')) !!}  
                {!! Form::text('name_ar',old('name_ar'),['class'=>'form-control', 'placeholder'=>trans('admin.name_ar')]) !!}  
              </div>
              <div class="form-group">
                {!! Form::label('Name_en', trans('admin.name_en')) !!}  
                {!! Form::text('name_en',old('name_en'),['class'=>'form-control','placeholder'=>trans('admin.name_en')]) !!}  
              </div>
              <div class="form-group">
                {!! Form::label('Logo', trans('admin.country_flag')) !!}  
                {!! Form::file('logo', ['class'=>'form-control']) !!}  
              </div>
              <div class="form-group">
                {!! Form::label('Mob', trans('admin.mob')) !!}  
                {!! Form::text('mob', old('mob'),['placeholder'=>trans('admin.mob'),'class'=>'form-control']) !!}  
              </div>
              <div class="form-group">
                {!! Form::label('Code', trans('admin.code')) !!}  
                {!! Form::text('code', old('code'),['class'=>'form-control', 'placeholder'=>trans('admin.code')]) !!}  
              </div>
              {!! Form::submit(trans('admin.add_country'), ['class' =>'btn btn-primary']) !!}
              {!! Form::close() !!}
            </div> 
          </div>
        </div>
      </div>
    </section>

<!-- Modal -->

@endsection