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
              {!!Form::open(['url'=>aurl('accessories'), 'files'=>true])!!}
              <div class="form-group">
                {!! Form::label('Name_ar', trans('admin.accesso_name_ar')) !!}  
                {!! Form::text('name_ar',old('name_ar'),['class'=>'form-control', 'placeholder'=>trans('admin.accesso_name_ar')]) !!}  
              </div>
              <div class="form-group">
                {!! Form::label('Name_en', trans('admin.accesso_name_en')) !!}  
                {!! Form::text('name_en',old('name_en'),['class'=>'form-control','placeholder'=>trans('admin.accesso_name_en')]) !!}  
              </div>
               <div class="form-group">
                {!! Form::label('Prod_Name_ar', trans('admin.prod_name_ar')) !!}  
                {!! Form::text('prod_name_ar',old('prod_name_ar'),['class'=>'form-control', 'placeholder'=>trans('admin.prod_name_ar')]) !!}  
              </div>
              <div class="form-group">
                {!! Form::label('Prod_Name_en', trans('admin.prod_name_en')) !!}  
                {!! Form::text('prod_name_en',old('prod_name_en'),['class'=>'form-control','placeholder'=>trans('admin.prod_name_en')]) !!}  
              </div>
              <div class="form-group">
                {!! Form::label('Photo', trans('admin.accesso_photo')) !!}  
                {!! Form::file('photo', ['class'=>'form-control']) !!}  
              </div>
              {!! Form::submit(trans('admin.add'), ['class' =>'btn btn-primary']) !!}
              {!! Form::close() !!}
            </div> 
          </div>
        </div>
      </div>
    </section>

<!-- Modal -->

@endsection