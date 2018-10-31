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
              {!!Form::open(['url'=>aurl('products'), 'files'=>true])!!}
              <div class="form-group">
                {!! Form::label('Name_ar', trans('admin.products_name_ar')) !!}  
                {!! Form::text('name_ar',old('name_ar'),['class'=>'form-control', 'placeholder'=>trans('admin.products_name_ar')]) !!}  
              </div>
              <div class="form-group">
                {!! Form::label('Name_en', trans('admin.products_name_en')) !!}  
                {!! Form::text('name_en',old('name_en'),['class'=>'form-control','placeholder'=>trans('admin.products_name_en')]) !!}  
              </div>
               <div class="form-group">
                {!! Form::label('color_Name_en', trans('admin.color_name_en')) !!}  
                {!! Form::text('color_name_en',old('color_name_en'),['class'=>'form-control','placeholder'=>trans('admin.color_name_en')]) !!}  
              </div><div class="form-group">
                {!! Form::label('color_Name_ar', trans('admin.color_name_ar')) !!}  
                {!! Form::text('color_name_ar',old('color_name_ar'),['class'=>'form-control','placeholder'=>trans('admin.color_name_ar')]) !!}  
              </div>
            </div>
               <div class="form-group">
                {!! Form::label('Color', trans('admin.color')) !!}  
                {!! Form::color('color',old('color'),['class'=>'form-control','placeholder'=>trans('admin.color')]) !!}  
              </div>
              <div class="form-group">
                {!! Form::label('Model', trans('admin.products_model')) !!}  
                {!! Form::text('model',old('model'),['class'=>'form-control','placeholder'=>trans('admin.products_model')]) !!}  
              </div>
              <div class="form-group">
                {!! Form::label('Brand', trans('admin.brand')) !!}  
                {!! Form::select('brand',\App\Models\TradeMarks::pluck('name_'.settings()->main_lang,'id'),old('brand'),['class'=>'form-control','placeholder'=>'........']) !!}  
              </div>
              <div class="form-group">
                {!! Form::label('Depart', trans('admin.dep')) !!}
                {!! Form::select('parent',\App\Models\Department::pluck('dep_name_'.settings()->main_lang,'id'),old('parent'),['class'=>'form-control','placeholder'=>'...........']) !!}    
              </div>
              <div class="form-group">
                {!! Form::label('Size', trans('admin.products_size')) !!}
                {!! Form::select('size',['large'=>trans('admin.large'),'medium'=>trans('admin.medium'),'small'=>trans('admin.small')],old('size'),['class'=>'form-control','placeholder'=>'...........']) !!}    
              </div>
              <div class="form-group">
                {!! Form::label('Description', trans('admin.desc')) !!}  
                {!! Form::textarea('description',old('description'),['class'=>'form-control','placeholder'=>trans('admin.desc')]) !!}  
              </div>
              <div class="form-group">
                {!! Form::label('Catalog', trans('admin.catalog')) !!}  
                {!! Form::file('catalog', ['class'=>'form-control']) !!}  
              </div>
               <div class="form-group">
                {!! Form::label('Discount', trans('admin.discount')) !!}  
                {!! Form::text('discount',old('discount'),['class'=>'form-control','placeholder'=>trans('admin.discount')."%"]) !!}  
              </div>
              <div class="form-group">
                {!! Form::label('Prics', trans('admin.price')) !!}  
                {!! Form::text('price',old('price'),['class'=>'form-control','placeholder'=>trans('admin.price')]) !!}  
              </div>
              <div class="form-group">
                {!! Form::label('Shipping', trans('admin.shipping_cost')) !!}  
                {!! Form::text('shipping_cost',old('shipping_cost'),['class'=>'form-control','placeholder'=>trans('admin.shipping_cost')]) !!}  
              </div>
              <div class="form-group">
                {!! Form::label('Photo', trans('admin.products_photo')) !!}  
                {!! Form::file('logo', ['class'=>'form-control']) !!}  
              </div>
              {!! Form::submit(trans('admin.create_product'), ['class' =>'btn btn-primary']) !!}
              {!! Form::close() !!}
              </div>
            </div> 
          </div>
        </div>
      </div>
    </section>

<!-- 
payment
on_receipt
credit_card -->

@endsection