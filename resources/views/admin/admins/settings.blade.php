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
              {!!Form::open(['url'=>aurl('settings'), 'files'=>true])!!}
              <div class="form-group">
                {!!Form::label('Name_en', trans('admin.en_lang'))!!}  
                {!!Form::text('sitename_en',settings()->sitename_en,['class'=>'form-control', 'placeholder'=>trans('admin.en_lang')])!!}  
              </div>
              <div class="form-group">
                {!!Form::label('Name_ar', trans('admin.ar_lang'))!!}  
                {!!Form::text('sitename_ar',settings()->sitename_ar,['class'=>'form-control','placeholder'=>trans('admin.ar_lang')])!!}  
              </div>
              <div class="form-group">
                {!!Form::label('Main_currency', trans('admin.main_currency'))!!}  
                {!!Form::text('main_currency',settings()->main_currency,['class'=>'form-control','placeholder'=>"EGP or USD or EUR"])!!}  
              </div>
              <div class="form-group">
                {!!Form::label('Euro_egypt', trans('admin.euro_egypt'))!!}  
                {!!Form::text('euro_egypt',settings()->euro_egypt,['class'=>'form-control','placeholder'=>trans('admin.euro_egypt')])!!}  
              </div>
              <div class="form-group">
                {!!Form::label('Dollar_egypt', trans('admin.dollar_egypt'))!!}  
                {!!Form::text('dollar_egypt',settings()->dollar_egypt,['class'=>'form-control','placeholder'=>trans('admin.dollar_egypt')])!!}  
              </div>
              <div class="form-group">
                {!!Form::label('Logo', trans('admin.logo'))!!}  
                {!!Form::file('logo',['class'=>'form-control'])!!}
                @if(!empty(settings()->logo))
                  <img src="{{Storage::url(settings()->logo)}}" style="width: 100px; height: 100px;">
                @endif   
              </div>
              <div class="form-group">
                {!! Form::label('Icon', trans('admin.icon'))!!}  
                {!! Form::file('icon',['class'=>'form-control'])!!}  
                @if(!empty(settings()->icon))
                  <img src="{{Storage::url(settings()->icon)}}" style="width: 100px; height: 100px;">
                @endif  
              </div>
              <div class="form-group">
                {!!Form::label('Email', trans('admin.email'))!!}  
                {!!Form::email('mail',settings()->mail,['placeholder'=>trans('admin.email'),'class'=>'form-control'])!!}  
              </div>
              <div class="form-group">
                {!!Form::label('Facebook', trans('admin.facebook'))!!}  
                {!!Form::text('facebook',settings()->facebook,['placeholder'=>trans('admin.facebook'),'class'=>'form-control'])!!}  
              </div>
              <div class="form-group">
                {!!Form::label('Twitter', trans('admin.twitter'))!!}  
                {!!Form::text('twitter',settings()->twitter,['placeholder'=>trans('admin.twitter'),'class'=>'form-control'])!!}  
              </div>
              <div class="form-group">
                {!!Form::label('Insta', trans('admin.insta'))!!}  
                {!!Form::text('insta',settings()->insta,['placeholder'=>trans('admin.insta'),'class'=>'form-control'])!!}  
              </div>
              <div class="form-group">
                {!!Form::label('Address1', trans('admin.address1'))!!}  
                {!!Form::text('address1',settings()->address1,['placeholder'=>trans('admin.address1'),'class'=>'form-control'])!!}  
              </div>
              <div class="form-group">
                {!!Form::label('Address2', trans('admin.address2'))!!}  
                {!!Form::text('address2',settings()->address2,['placeholder'=>trans('admin.address2'),'class'=>'form-control'])!!}  
              </div>
              <div class="form-group">
                {!!Form::label('Country', trans('admin.country'))!!}  
                {!!Form::text('country',settings()->country,['placeholder'=>trans('admin.country'),'class'=>'form-control'])!!}  
              </div>
              <div class="form-group">
                {!!Form::label('Phone', trans('admin.phone'))!!}  
                {!!Form::text('phone',settings()->phone,['placeholder'=>trans('admin.phone'),'class'=>'form-control'])!!}  
              </div>
              <div class="form-group">
                {!!Form::label('Fax', trans('admin.fax'))!!}  
                {!!Form::text('fax',settings()->fax,['placeholder'=>trans('admin.fax'),'class'=>'form-control'])!!}  
              </div>
              <div class="form-group">
                {!!Form::label('Main_Lang', trans('admin.main_language'))!!}  
                {!!Form::select('main_lang',['en'=>'English','ar'=>'عربي'],settings()->main_lang,['placeholder'=>trans('admin.main_language'),'class'=>'form-control'])!!}  
              </div>
              <div class="form-group">
                {!!Form::label('DeliveryTime', trans('admin.time_to_deliver'))!!}  
                {!!Form::text('time_to_deliver',settings()->time_to_deliver,['placeholder'=>trans('admin.time_to_deliver'),'class'=>'form-control'])!!}  
              </div>
              <div class="form-group">
                {!! Form::label('Description', trans('admin.descr'))!!}  
                {!! Form::textarea('description',settings()->description,['class'=>'form-control'])!!}  
              </div>
              <div class="form-group">
                {!! Form::label('Manager', trans('admin.manager'))!!}  
                {!! Form::textarea('manager',settings()->manager,['class'=>'form-control'])!!}  
              </div>
              <div class="form-group">
                {!! Form::label('Site_admin', trans('admin.site_admin'))!!}  
                {!! Form::textarea('site_admin',settings()->site_admin,['class'=>'form-control'])!!}  
              </div>
              <div class="form-group">
                {!! Form::label('Wish', trans('admin.wish'))!!}  
                {!! Form::textarea('wish',settings()->wish,['class'=>'form-control'])!!}  
              </div>
              <div class="form-group">
                {!! Form::label('About', trans('admin.about'))!!}  
                {!! Form::textarea('about_us',settings()->about_us,['class'=>'form-control'])!!}  
              </div>
              <div class="form-group">
                {!!Form::label('Keywords', trans('admin.key'))!!}  
                {!!Form::textarea('keywords',settings()->keywords,['class'=>'form-control'])!!}  
              </div>
              <div class="form-group">
                {!!Form::label('Status', trans('admin.stat'))!!}  
                {!!Form::select('status',['opened'=>trans('admin.opened'),'closed'=>trans('admin.closed')],settings()->status,['class'=>'form-control'])!!}  
              </div>
              <div class="form-group">
                {!!Form::label('Message_Maintenance', trans('admin.maintenance'))!!}  
                {!!Form::textarea('message_maintenance',settings()->message_maintenance,['class'=>'form-control'])!!}  
              </div>
              {!!Form::submit(trans('admin.save'),['class'=>'btn btn-primary'])!!}
              {!!Form::close()!!}
            </div> 
          </div>
        </div>
      </div>
    </section>
    

<!-- Modal -->

@endsection