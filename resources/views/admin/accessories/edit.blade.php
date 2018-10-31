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
              {{Form::open(['url'=>aurl('accessories/'.$accessories->id), 'method' => 'PUT', 'files'=>true])}}
             <div class="form-group">
                {{Form::label('Name_ar', trans('admin.accesso_name_ar'))}}  
                {{Form::text('name_ar',$accessories->name_ar,['class'=>'form-control', 'placeholder'=>trans('admin.accesso_name_ar')])}}  
              </div>
              <div class="form-group">
                {{Form::label('Name_en', trans('admin.accesso_name_en'))}}  
                {{Form::text('name_en',$accessories->name_en,['class'=>'form-control','placeholder'=>trans('admin.accesso_name_en')])}}  
              </div>
              <div class="form-group">
                {{Form::label('Prod_Name_ar', trans('admin.prod_name_ar'))}}  
                {{Form::text('prod_name_ar',$accessories->prod_name_ar,['class'=>'form-control', 'placeholder'=>trans('admin.prod_name_ar')])}}  
              </div>
              <div class="form-group">
                {{Form::label('Prod_Name_en', trans('admin.prod_name_en'))}}  
                {{Form::text('prod_name_en',$accessories->prod_name_en,['class'=>'form-control','placeholder'=>trans('admin.prod_name_en')])}}  
              </div>
              <div class="form-group">
                {{Form::label('Photo', trans('admin.accesso_photo'))}}  
                {{Form::file('photo',['placeholder'=>trans('admin.accesso_photo'),'class'=>'form-control'])}} 
                <img src="{{Storage::url($accessories->photo)}}" style="height: 200px; width: 200px;"> 
              </div>
              {{Form::submit(trans('admin.edit_accessories'),['class' => 'btn btn-primary'])}}
              {{Form::close()}}
            </div> 
          </div>
        </div>
      </div>
    </section>

<!-- Modal -->

@endsection