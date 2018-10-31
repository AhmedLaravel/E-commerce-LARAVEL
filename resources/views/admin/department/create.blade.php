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
              {!!Form::open(['url'=>aurl('department'), 'files'=>true])!!}
              <div class="form-group">
                {!! Form::label('Name_ar', trans('admin.dep_name_ar')) !!}  
                {!! Form::text('dep_name_ar',old('dep_name_ar'),['class'=>'form-control', 'placeholder'=>trans('admin.dep_name_ar')]) !!}  
              </div>
              <div class="form-group">
                {!! Form::label('Name_en', trans('admin.dep_name_en')) !!}  
                {!! Form::text('dep_name_en',old('dep_name_en'),['class'=>'form-control','placeholder'=>trans('admin.dep_name_en')]) !!}  
              </div> 
              <div class="form-group">
                {!! Form::label('Photo', trans('admin.photo')) !!}  
                {!! Form::file('photo',['class'=>'form-control']) !!}  
              </div> 
              <div class="form-group">
                {{Form::label('Hint', trans('admin.hint'))}}  
                {{Form::textarea('hint',old('hint'),['class'=>'form-control','placeholder'=>trans('admin.hint')])}}  
              </div>
              {!! Form::submit(trans('admin.add_dep'), ['class' =>'btn btn-primary']) !!}
              {!! Form::close() !!}
            </div> 
          </div>
        </div>
      </div>
    </section>

<!-- Modal -->

@endsection