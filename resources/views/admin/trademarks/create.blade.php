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
              {!!Form::open(['url'=>aurl('trademarks'), 'files'=>true])!!}
              <div class="form-group">
                {!! Form::label('Name_ar', trans('admin.trade_name_ar')) !!}  
                {!! Form::text('name_ar',old('name_ar'),['class'=>'form-control', 'placeholder'=>trans('admin.trade_name_ar')]) !!}  
              </div>
              <div class="form-group">
                {!! Form::label('Name_en', trans('admin.trade_name_en')) !!}  
                {!! Form::text('name_en',old('name_en'),['class'=>'form-control','placeholder'=>trans('admin.trade_name_en')]) !!}  
              </div>
              <div class="form-group">
                {!! Form::label('Depart', trans('admin.dep')) !!}
                {!! Form::select('department',\App\Models\Department::pluck('dep_name_'.settings()->main_lang,'id'),old('department'),['class'=>'form-control','placeholder'=>'...........']) !!}    
              </div>
              <div class="form-group">
                {!! Form::label('Logo', trans('admin.trade_marke_logo')) !!}  
                {!! Form::file('logo', ['class'=>'form-control']) !!}  
              </div>
              {!! Form::submit(trans('admin.create_trade_marke'), ['class' =>'btn btn-primary']) !!}
              {!! Form::close() !!}
            </div> 
          </div>
        </div>
      </div>
    </section>

<!-- Modal -->

@endsection