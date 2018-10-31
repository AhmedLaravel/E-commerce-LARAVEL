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
              {{Form::open(['url'=>aurl('manifacts/'.$manifact->id), 'method' => 'PUT', 'files'=>true])}}
            <div class="form-group">
                {!! Form::label('Name_ar', trans('admin.manifact_name_ar')) !!}  
                {!! Form::text('name_ar',$manifact->name_ar,['class'=>'form-control', 'placeholder'=>trans('admin.manifact_name_ar')]) !!}  
              </div>
              <div class="form-group">
                {!! Form::label('Name_en', trans('admin.manifact_name_en')) !!}  
                {!! Form::text('name_en',$manifact->name_en,['class'=>'form-control','placeholder'=>trans('admin.manifact_name_en')]) !!}  
              </div>
              <div class="form-group">
                {!! Form::label('Email', trans('admin.email')) !!}  
                {!! Form::email('email',$manifact->email,['class'=>'form-control','placeholder'=>trans('admin.email')]) !!}  
              </div>
              <div class="form-group">
                {!! Form::label('Mobile', trans('admin.mobile')) !!}  
                {!! Form::text('mobile',$manifact->mobile,['class'=>'form-control','placeholder'=>trans('admin.mobile')]) !!}  
              </div>
              <div class="form-group">
                {!! Form::label('Address', trans('admin.address')) !!}  
                {!! Form::text('address', $manifact->address,['class'=>'form-control address' ]) !!}
              </div>
              <div class="form-group">
                {!! Form::label('Facebook', trans('admin.manifact_facebook')) !!}  
                {!! Form::text('facebook',$manifact->facebook,['class'=>'form-control','placeholder'=>trans('admin.manifact_facebook')]) !!}  
              </div>
              <div class="form-group">
                {!! Form::label('Twitter', trans('admin.manifact_twitter')) !!}  
                {!! Form::text('twitter',$manifact->twitter,['class'=>'form-control','placeholder'=>trans('admin.manifact_twitter')]) !!}  
              </div>
              <div class="form-group">
                {!! Form::label('Website', trans('admin.manifact_website')) !!}  
                {!! Form::text('website',$manifact->website,['class'=>'form-control','placeholder'=>trans('admin.manifact_website')]) !!}  
              </div>
              <div class="form-group">
                {!! Form::label('Contact_name', trans('admin.manifact_contact_name')) !!}  
                {!! Form::text('contact_name',$manifact->contact_name,['class'=>'form-control','placeholder'=>trans('admin.manifact_contact_name')]) !!}  
              </div>
              <div class="form-group">
                {!! Form::label('Icon', trans('admin.manifact_icon')) !!}  
                {!! Form::file('icon', ['class'=>'form-control']) !!}  
                @if(!empty($manifact->icon))
                  <img src="{{Storage::url($manifact->icon)}}" style="height: 100px; width: 100px;">
                @endif
              </div>
              {{Form::submit(trans('admin.edit'),['class' => 'btn btn-primary'])}}
              {{Form::close()}}
            </div> 
          </div>
        </div>
      </div>
    </section>

<!-- Modal -->

@endsection