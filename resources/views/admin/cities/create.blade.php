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
              {!!Form::open(['url'=>aurl('cities'), 'files'=>true])!!}
              <div class="form-group">
                {!! Form::label('Name_ar', trans('admin.city_name_ar')) !!}  
                {!! Form::text('name_ar',old('name_ar'),['class'=>'form-control', 'placeholder'=>trans('admin.city_name_ar')]) !!}  
              </div>
              <div class="form-group">
                {!! Form::label('Name_en', trans('admin.city_name_en')) !!}  
                {!! Form::text('name_en',old('name_en'),['class'=>'form-control','placeholder'=>trans('admin.city_name_en')]) !!}  
              </div>
              <div class="form-group">
                {!! Form::label('Country_id', trans('admin.country_id')) !!}  
                {!! Form::select('country_id', \App\Models\Countries::pluck(session()->has('lang')?'name_'.settings()->main_lang:name_en,'id') ,old('country_id'),['class'=>'form-control']) !!}  
              </div>
              {!! Form::submit(trans('admin.add_city'), ['class' =>'btn btn-primary']) !!}
              {!! Form::close() !!}
            </div> 
          </div>
        </div>
      </div>
    </section>

<!-- Modal -->

@endsection