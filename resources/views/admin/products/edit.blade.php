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
              {{Form::open(['url'=>aurl('products/'.$products->id), 'method' => 'PUT', 'files'=>true])}}
            <div class="form-group">
                {!! Form::label('Name_ar', trans('admin.products_name_ar')) !!}  
                {!! Form::text('name_ar',$products->name_ar,['class'=>'form-control', 'placeholder'=>trans('admin.products_name_ar')]) !!}  
              </div>
              <div class="form-group">
                {!! Form::label('Name_en', trans('admin.products_name_en')) !!}  
                {!! Form::text('name_en',$products->name_en,['class'=>'form-control','placeholder'=>trans('admin.products_name_en')]) !!}  
              </div>
              <div class="form-group">
                {!! Form::label('color_Name_en', trans('admin.color_name_en')) !!}  
                {!! Form::text('color_name_en',$products->color_name_en,['class'=>'form-control','placeholder'=>trans('admin.color_name_en')]) !!}  
              </div><div class="form-group">
                {!! Form::label('color_Name_ar', trans('admin.color_name_ar')) !!}  
                {!! Form::text('color_name_ar',$products->color_name_ar,['class'=>'form-control','placeholder'=>trans('admin.color_name_ar')]) !!}  
              </div>
               <div class="form-group">
                {!! Form::label('Color', trans('admin.color')) !!}  
                {!! Form::color('color',$products->color,['class'=>'form-control','placeholder'=>trans('admin.color')]) !!}  
              </div>
              <div class="form-group">
                {!! Form::label('Model', trans('admin.products_model')) !!}  
                {!! Form::text('model',$products->model,['class'=>'form-control','placeholder'=>trans('admin.products_model')]) !!}  
              </div>
              <div class="form-group">
                {!! Form::label('Brand', trans('admin.brand')) !!}  
                {!! Form::select('brand',\App\Models\TradeMarks::pluck('name_'.settings()->main_lang,'id'),$products->brand,['class'=>'form-control','placeholder'=>'........']) !!}  
              </div>
              <div class="form-group">
                {!! Form::label('Depart', trans('admin.dep')) !!}   
                {!! Form::select('parent',\App\Models\Department::pluck('dep_name_'.settings()->main_lang,'id'),$products->parent,['class'=>'form-control','placeholder'=>'........']) !!}  
              </div>
              <div class="form-group">
                {!! Form::label('Size', trans('admin.products_size')) !!}
                {!! Form::select('size',['large'=>trans('admin.large'),'medium'=>trans('admin.medium'),'small'=>trans('admin.small')],$products->size,['class'=>'form-control','placeholder'=>'...........']) !!}    
              </div>
              
              <div class="form-group">
                {!! Form::label('Description', trans('admin.desc')) !!}  
                {!! Form::textarea('description',$products->description,['class'=>'form-control','placeholder'=>trans('admin.desc')]) !!}  
              </div>
              <div class="form-group">
                {!! Form::label('Catalog', trans('admin.catalog')) !!}  
                {!! Form::file('catalog', ['class'=>'form-control']) !!} 
              </div>
              @if(!empty($products->file_name))
                <a href="{{ aurl('download/'.$products->id.'/'.str_slug($products->file_name, '-')) }}" style="font-weight: bold; size: 14px;">{{$products->file_name}}</a>
                <br>
                <br>
              @else
                  <span style="color: black; font-weight: bold; size: 14px;"> {{trans('admin.nofile')}} </span>
                  <br>
                  <br>
              @endif
               <div class="form-group">
                {!! Form::label('Discount', trans('admin.discount')) !!}  
                {!! Form::text('discount',$products->discount,['class'=>'form-control','placeholder'=>trans('admin.discount'),"%"]) !!}  
              </div>
              <div class="form-group">
                {!! Form::label('Prics', trans('admin.price')) !!}  
                {!! Form::text('price',$products->price,['class'=>'form-control','placeholder'=>trans('admin.price')]) !!}  
              </div>
               <div class="form-group">
                {!! Form::label('Shipping', trans('admin.shipping_cost')) !!}  
                {!! Form::text('shipping_cost',$products->shipping_cost,['class'=>'form-control','placeholder'=>trans('admin.shipping_cost')]) !!}  
              </div>
              <div class="form-group">
                {!! Form::label('Photo', trans('admin.products_photo')) !!}  
                {!! Form::file('logo', ['class'=>'form-control']) !!} 
                @if(!empty($products->logo))
                <img src='{{ Storage::url("$products->logo")}}' style="height: 100px; width: 100px;">
                @endif 
              </div>
              {{Form::submit(trans('admin.edit_products'),['class' => 'btn btn-primary'])}}
              {{Form::close()}}
              </div>
            </div> 
          </div>
        </div>
      </div>
    </section>

<!-- Modal -->

@endsection