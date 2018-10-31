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
              {{Form::open(['url'=>aurl('countries/'.$country->id), 'method' => 'PUT', 'files'=>true])}}
             <div class="form-group">
                {{Form::label('Name_ar', trans('admin.name_ar'))}}  
                {{Form::text('name_ar',$country->name_ar,['class'=>'form-control', 'placeholder'=>trans('admin.name_ar')])}}  
              </div>
              <div class="form-group">
                {{Form::label('Name_en', trans('admin.name_en'))}}  
                {{Form::text('name_en',$country->name_en,['class'=>'form-control','placeholder'=>trans('admin.name_en')])}}  
              </div>
              <div class="form-group">
                {{Form::label('Logo', trans('admin.country_flag'))}}  
                {{Form::file('logo',['placeholder'=>trans('admin.country_flag'),'class'=>'form-control'])}} 
                <img src="{{Storage::url($country->logo)}}" style="height: 200px; width: 200px;"> 
              </div>
              <div class="form-group">
                {{Form::label('Mob', trans('admin.mob'))}}  
                {{Form::text('mob',$country->mob,['placeholder'=>trans('admin.mob'),'class'=>'form-control'])}}  
              </div>
              <div class="form-group">
                {{Form::label('Code', trans('admin.code'))}}  
                {{Form::text('code',$country->code,['class'=>'form-control', 'placeholder'=>trans('admin.code')])}}  
              </div>
              {{Form::submit(trans('admin.edit_country'),['class' => 'btn btn-primary'])}}
              {{Form::close()}}
            </div> 
          </div>
        </div>
      </div>
    </section>

<!-- Modal -->

@endsection