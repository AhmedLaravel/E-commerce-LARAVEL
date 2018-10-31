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
              {!! Form::label('Name',trans('admin.use_name')) !!}
              <p> <span class="label label-info" style="font-size: 17px;"> {{$review->name}} </span> </p>
              <br>
              <hr>
              {!! Form::label('Email',trans('admin.email')) !!}
              <p>  {{$review->email}}  </p>
              <br>
              <hr>
              {!! Form::label('Rate',trans('admin.user_rate')) !!}
              <p> <span> {{$review->rate.' '}} </span> {{trans('admin.star')}} </p>
              <br>
              <hr>
              {!! Form::label('Review',trans('admin.review')) !!}
              <p>  {{$review->review}}  </p>
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
