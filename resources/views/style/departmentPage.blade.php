@extends('style.index')
@section('content')
<!-- start banner -->
<div class="shop_top">
		<div class="container">
			<center><h2 style="color: blue;">{{trans('admin.deps')}}</h2></center>
			<div class="row shop_box-top">
				@foreach($deps as $department)
				<div class="col-md-3 shop_box"><a href="{{url('tradeMarks/'.$department->id)}}">
					<img src="{{Storage::url($department->photo)}}" class="img-responsive" alt="" style="height: 300px; width: 200px;">
						<div class="special-info grid_1 simpleCart_shelfItem">
							<h5>{{session('lang') == 'ar'? $department->dep_name_ar: $department->dep_name_en}}</h5>
						</div>
					</a>
				</div>
				@endforeach
				</div>
			</div>
	   </div>

@endsection