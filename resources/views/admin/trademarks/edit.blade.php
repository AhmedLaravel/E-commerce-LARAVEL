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
              {{Form::open(['url'=>aurl('trademarks/'.$trademark->id), 'method' => 'PUT', 'files'=>true])}}
            <div class="form-group">
                {!! Form::label('Name_ar', trans('admin.trade_name_ar')) !!}  
                {!! Form::text('name_ar',$trademark->name_ar,['class'=>'form-control', 'placeholder'=>trans('admin.trade_name_ar')]) !!}  
              </div>
              <div class="form-group">
                {!! Form::label('Name_en', trans('admin.trade_name_en')) !!}  
                {!! Form::text('name_en',$trademark->name_en,['class'=>'form-control','placeholder'=>trans('admin.trade_name_en')]) !!}  
              </div>
               <div class="form-group">
                {!! Form::label('Depart', trans('admin.dep')) !!}   
                {!! Form::select('department',\App\Models\Department::pluck('dep_name_'.settings()->main_lang,'id'),$trademark->department,['class'=>'form-control','placeholder'=>'........']) !!}  
              </div>
              <div class="form-group">
                {!! Form::label('Logo', trans('admin.trade_marke_logo')) !!}  
                {!! Form::file('logo', ['class'=>'form-control']) !!}  
                @if(!empty($trademark->logo))
                  <img src="{{Storage::url($trademark->logo)}}" style="height: 100px; width: 100px;">
                @endif
              </div>
              {{Form::submit(trans('admin.edit_tradeMark'),['class' => 'btn btn-primary'])}}
              {{Form::close()}}
            </div> 
          </div>
        </div>
      </div>
    </section>

<!-- Modal -->

@endsection