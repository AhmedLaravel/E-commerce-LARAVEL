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
              {{Form::open(['url'=>aurl('department/'.$department->id), 'method' => 'PUT', 'files'=>true])}}
             <div class="form-group">
                {{Form::label('Name_ar', trans('admin.city_name_ar'))}}  
                {{Form::text('dep_name_ar',$department->dep_name_ar,['class'=>'form-control', 'placeholder'=>trans('admin.dep_name_ar')])}}  
              </div>
              <div class="form-group">
                {{Form::label('Name_en', trans('admin.city_name_en'))}}  
                {{Form::text('dep_name_en',$department->dep_name_en,['class'=>'form-control','placeholder'=>trans('admin.dep_name_en')])}}  
              </div>
              <div class="form-group">
                {!! Form::label('Photo', trans('admin.photo')) !!}  
                {!! Form::file('photo',['class'=>'form-control']) !!}  
              </div> 
              @if(!empty($department->photo))
              <img src="{{Storage::url($department->photo)}}" style="height: 100px; width: 100px;">
              @endif
              <div class="form-group">
                {!! Form::label('Hint', trans('admin.hint')) !!}  
                {!! Form::textarea('hint',$department->hint,['class'=>'form-control','placeholder'=>trans('admin.hint')]) !!}  
              </div>
              {{Form::submit(trans('admin.edit_dep'),['class' => 'btn btn-primary'])}}
              {{Form::close()}}
            </div> 
          </div>
        </div>
      </div>
    </section>

<!-- Modal -->

@endsection