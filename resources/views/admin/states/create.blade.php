@extends('admin.index')
@section('content')
@push('js')
  <script type="text/javascript">
    $(document).ready(function(){
      @if(old('country_id'))
        $.ajax({
              url: "{{aurl('states/create')}}",
              type:'get',
              dataType:'html',
              data:{country_id:"{{old('country_id')}}",select:"{{old('city_id')}}"},
              success: function(data){
                $('.city').html(data);
              }
          });
      @endif
    });
    
    $(document).ready(function(){
      $(document).on('change','.country_id',function(){
        var country = $('.country_id option:selected').val();
        if(country > 0){
          $.ajax({
              url: "{{aurl('states/create')}}",
              type:'get',
              dataType:'html',
              data:{country_id:country,select:''},
              success: function(data){
                $('.city').html(data);
              }
          });
        }else{
          $('.city').html('');
        }
      });
    });

  </script>
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
              {!!Form::open(['url'=>aurl('states')])!!}
              <div class="form-group">
                {!! Form::label('Name_ar', trans('admin.state_name_ar')) !!}  
                {!! Form::text('name_ar',old('name_ar'),['class'=>'form-control', 'placeholder'=>trans('admin.state_name_ar')]) !!}  
              </div>
              <div class="form-group">
                {!! Form::label('Name_en', trans('admin.state_name_en')) !!}  
                {!! Form::text('name_en',old('name_en'),['class'=>'form-control','placeholder'=>trans('admin.state_name_en')]) !!}  
              </div>
              <div class="form-group">
                {!! Form::label('Country_id', trans('admin.country_id')) !!}  
                {!! Form::select('country_id', \App\Models\Countries::pluck(session()->has('lang')?'name_'.session('lang'):name_en,'id') ,old('country_id'),['class'=>'form-control country_id', 'placeholder'=>'.............'])!!}
              </div>
               <div class="form-group">
                {!! Form::label('City_id', trans('admin.city_id')) !!}
                <span class="city"></span>
              </div>
              {!! Form::submit(trans('admin.add_state'), ['class' =>'btn btn-primary']) !!}
              {!! Form::close() !!}
            </div> 
          </div>
        </div>
      </div>
    </section>

<!-- Modal -->

@endsection