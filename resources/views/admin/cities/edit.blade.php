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
              {{Form::open(['url'=>aurl('cities/'.$city->id), 'method' => 'PUT', 'files'=>true])}}
             <div class="form-group">
                {{Form::label('Name_ar', trans('admin.city_name_ar'))}}  
                {{Form::text('name_ar',$city->name_ar,['class'=>'form-control', 'placeholder'=>trans('admin.name_ar')])}}  
              </div>
              <div class="form-group">
                {{Form::label('Name_en', trans('admin.city_name_en'))}}  
                {{Form::text('name_en',$city->name_en,['class'=>'form-control','placeholder'=>trans('admin.name_en')])}}  
              </div>
             <div class="form-group">
                 {!! Form::label('Country_id', trans('admin.country_id')) !!}  
                {!! Form::select('country_id', \App\Models\Countries::pluck('name_'.settings()->main_lang,'id'),$city->country_id,['class'=>'form-control']) !!}  
              </div>
              {{Form::submit(trans('admin.edit_city'),['class' => 'btn btn-primary'])}}
              {{Form::close()}}
            </div> 
          </div>
        </div>
      </div>
    </section>

<!-- Modal -->

@endsection