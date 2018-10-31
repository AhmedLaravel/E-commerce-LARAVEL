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
              {!!Form::open(['url'=>aurl('manifacts'), 'files'=>true])!!}
              <div class="form-group">
                {!! Form::label('Name_ar', trans('admin.manifact_name_ar')) !!}  
                {!! Form::text('name_ar',old('name_ar'),['class'=>'form-control', 'placeholder'=>trans('admin.manifact_name_ar')]) !!}  
              </div>
              <div class="form-group">
                {!! Form::label('Name_en', trans('admin.manifact_name_en')) !!}  
                {!! Form::text('name_en',old('name_en'),['class'=>'form-control','placeholder'=>trans('admin.manifact_name_en')]) !!}  
              </div>
              <div class="form-group">
                {!! Form::label('Email', trans('admin.email')) !!}  
                {!! Form::email('email',old('email'),['class'=>'form-control','placeholder'=>trans('admin.email')]) !!}  
              </div>
              <div class="form-group">
                {!! Form::label('Mobile', trans('admin.mobile')) !!}  
                {!! Form::text('mobile',old('mobile'),['class'=>'form-control','placeholder'=>trans('admin.mobile')]) !!}  
              </div>
              <div class="form-group">
                {!! Form::label('Address', trans('admin.address')) !!}  
                {!! Form::text('address', old('address'),['class'=>'form-control address' ]) !!}
              </div>
              <div class="form-group">
                {!! Form::label('Facebook', trans('admin.manifact_facebook')) !!}  
                {!! Form::text('facebook',old('facebook'),['class'=>'form-control','placeholder'=>trans('admin.manifact_facebook')]) !!}  
              </div>
              <div class="form-group">
                {!! Form::label('Twitter', trans('admin.manifact_twitter')) !!}  
                {!! Form::text('twitter',old('twitter'),['class'=>'form-control','placeholder'=>trans('admin.manifact_twitter')]) !!}  
              </div>
              <div class="form-group">
                {!! Form::label('Website', trans('admin.manifact_website')) !!}  
                {!! Form::text('website',old('website'),['class'=>'form-control','placeholder'=>trans('admin.manifact_website')]) !!}  
              </div>
              <div class="form-group">
                {!! Form::label('Contact_name', trans('admin.manifact_contact_name')) !!}  
                {!! Form::text('contact_name',old('contact_name'),['class'=>'form-control','placeholder'=>trans('admin.manifact_contact_name')]) !!}  
              </div>
              <div class="form-group">
                {!! Form::label('Icon', trans('admin.manifact_icon')) !!}  
                {!! Form::file('icon', ['class'=>'form-control']) !!}  
              </div>
              {!! Form::submit(trans('admin.create_manifact'), ['class' =>'btn btn-primary']) !!}
              {!! Form::close() !!}
            </div> 
          </div>
        </div>
      </div>
    </section>

<!-- Modal -->

@endsection

<!-- 
manifact_facebook
manifact_twitter
manifact_website
manifact_contact_name
manifact_contact_lat
manifact_contact_lng
manifact_icon
 -->
