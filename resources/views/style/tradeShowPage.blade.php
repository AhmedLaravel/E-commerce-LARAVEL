@extends('style.index')
@section('content')
<!-- start banner -->
<div class="shop_top">
		<div class="container">
			<div class="row shop_box-top">
				@foreach($trades as $trade)
				<div class="col-md-3 shop_box"><a href="{{url('trade/'.$trade->id)}}">
					<img src="{{Storage::url($trade->logo)}}" class="img-responsive" alt="" style="height: 300px; width: 200px;">
						<div class="special-info grid_1 simpleCart_shelfItem">
							<h5>{{session('lang') == 'ar'? $trade->name_ar: $trade->name_en}}</h5>
						</div>
					</a>
				</div>
				@endforeach
				</div>
			</div>
	   </div>

@endsection