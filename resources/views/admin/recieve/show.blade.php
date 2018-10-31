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
              <p> <span class="label label-info" style="font-size: 17px;"> {{$recieve->billing_first_name}} </span> </p>
              <br>
              <hr>
              {!! Form::label('Country',trans('admin.country')) !!}:
              <p>  {{$recieve->billing_country}}  </p>
              <br>
              <hr>
              {!! Form::label('Company',trans('admin.company')) !!}:
              <p>  {{$recieve->billing_company}}  </p>
              <br>
              <hr>
              {!! Form::label('Adress1',trans('admin.adress1')) !!}:
              <p>  {{$recieve->billing_address_1}}  </p>
              <br>
              <hr>
              {!! Form::label('Adress2',trans('admin.adress2')) !!}:
              <p>  {{$recieve->billing_address_2}}  </p>
              <br>
              <hr>
              {!! Form::label('City',trans('admin.city')) !!}:
              <p>  {{$recieve->billing_city}}  </p>
              <br>
              <hr>
              {!! Form::label('State',trans('admin.state')) !!}:
              <p>  {{$recieve->billing_state}}  </p>
              <br>
              <hr>
              {!! Form::label('Post_code',trans('admin.postal_code')) !!}:
              <p>  {{$recieve->billing_postcode}}  </p>
              <br>
              <hr>
              {!! Form::label('phone',trans('admin.phone')) !!}:
              <p>  {{$recieve->billing_phone}}  </p>
              <br>
              <hr>
              {!! Form::label('content',trans('admin.content')) !!}:
              <p>  {{$recieve->cart_content}}  </p>
              <br>
              <hr>
              {!! Form::label('Email',trans('admin.email')) !!}:
              <p>  {{$recieve->billing_email}}  </p>
              <br>
              <hr>
              {!! Form::label('Total',trans('admin.total')) !!}:
              <p>  {{currency_format($recieve->total,$recieve->currency)}}  </p>
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
