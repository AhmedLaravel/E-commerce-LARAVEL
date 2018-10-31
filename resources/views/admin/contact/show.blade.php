@extends('admin.index')
@section('content')
@push('js')
@endpush
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">{{$title}}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              {!! Form::label('Name',trans('admin.nam_user')) !!}
              <p> <span class="label label-info" style="font-size: 17px;"> {{$contact->name}} </span> </p>
              <br>
              <hr>
              {!! Form::label('Email',trans('admin.email')) !!}
              <p>  {{$contact->email}}  </p>
              <br>
              <hr>
              {!! Form::label('subject',trans('admin.subject')) !!}
              <p> <span> {{$contact->subject}} </span> </p>
              <br>
              <hr>
              {!! Form::label('Message',trans('admin.message')) !!}
              <p>  {{$contact->message}}  </p>
              <br>
              <hr>
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
