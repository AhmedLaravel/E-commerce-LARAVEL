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
              {{Form::open(['url'=>aurl('shipping/'.$shipping->id), 'method' => 'PUT', 'files'=>true])}}
              <div class="form-group">
            <div class="form-group">
                {!! Form::label('Name_ar', trans('admin.shipp_name_ar')) !!}  
                {!! Form::text('name_ar',$shipping->name_ar,['class'=>'form-control', 'placeholder'=>trans('admin.shipp_name_ar')]) !!}  
              </div>
              <div class="form-group">
                {!! Form::label('Name_en', trans('admin.shipp_name_en')) !!}  
                {!! Form::text('name_en',$shipping->name_en,['class'=>'form-control','placeholder'=>trans('admin.shipp_name_en')]) !!}  
              </div>
              <div class="form-group">
                {!! Form::label('Email', trans('admin.email')) !!}  
                {!! Form::email('email',$shipping->email,['class'=>'form-control','placeholder'=>trans('admin.email')]) !!}  
              </div>
              <div class="form-group">
                {!! Form::label('Mobile', trans('admin.mobile')) !!}  
                {!! Form::text('mobile',$shipping->mobile,['class'=>'form-control','placeholder'=>trans('admin.mobile')]) !!}  
              </div>
              <div class="form-group">
                {!! Form::label('Address', trans('admin.address')) !!}  
                {!! Form::text('address', $shipping->address,['class'=>'form-control address' ]) !!}
              </div>
              <div class="form-group">
                {!! Form::label('Facebook', trans('admin.shipp_facebook')) !!}  
                {!! Form::text('facebook',$shipping->facebook,['class'=>'form-control','placeholder'=>trans('admin.shipp_facebook')]) !!}  
              </div>
              <div class="form-group">
                {!! Form::label('Twitter', trans('admin.shipp_twitter')) !!}  
                {!! Form::text('twitter',$shipping->twitter,['class'=>'form-control','placeholder'=>trans('admin.shipp_twitter')]) !!}  
              </div>
              <div class="form-group">
                {!! Form::label('Website', trans('admin.shipp_website')) !!}  
                {!! Form::text('website',$shipping->website,['class'=>'form-control','placeholder'=>trans('admin.shipp_website')]) !!}  
              </div>
              <div class="form-group">
                {!! Form::label('Contact_name', trans('admin.shipp_contact_name')) !!}  
                {!! Form::text('contact_name',$shipping->contact_name,['class'=>'form-control','placeholder'=>trans('admin.shipp_contact_name')]) !!}  
              </div>
              <div class="form-group">
                {!! Form::label('Icon', trans('admin.shipp_icon')) !!}  
                {!! Form::file('icon', ['class'=>'form-control']) !!}  
                @if(!empty($shipping->icon))
                  <img src="{{Storage::url($shipping->icon)}}" style="height: 100px; width: 100px;">
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