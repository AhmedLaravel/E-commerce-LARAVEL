@extends('style.index')
@section('content')
<!-- start banner -->
<div class="about">
		<div class="container">
				<h3>{{trans('admin.about')}}</h3>
			<div class="about-top">
				@foreach($departments as $dep)
				<div class="col-md-3 about-1">
					<img src="{{Storage::url($dep->photo)}}" class="img-responsive" alt="">	
				</div>
				@endforeach
				<div class="clearfix"></div>	
			</div>
			<div class="about-top">
				@foreach($departments as $dep)
				<div class="col-md-3 about-2">
					<h4>{{ session('lang') == 'ar'? $dep->dep_name_ar:$dep->dep_name_en }}</h4>
					<p>{{$dep->hint}}</p>
				</div>
				@endforeach
				<div class="clearfix"></div>	
			</div>
			<div class="about-top">
				@if(!empty(settings()->manager))
				<div class="col-md-6 about-3">
					<h4>{{trans('admin.manager')}}</h4>
					<p>{{settings()->manager}}</p>
				</div>
				@endif
				<div class="clearfix"></div>	
				@if(!empty(settings()->site_admin))
				<div class="col-md-6 about-3">
					<h4>{{trans('admin.site_admin')}}</h4>
					<p>{{settings()->site_admin}}</p>
				</div>
				@endif
				<div class="clearfix"></div>	
				@if(!empty(settings()->wish))
				<div class="col-md-6 about-3">
					<h4>{{trans('admin.wish')}}</h4>
					<p>{{settings()->wish}}</p>
				</div>
				@endif
				<div class="clearfix"></div>	
			</div>
			<div class="col-md-12 shop-4">
			@if(!empty(settings()->keywords))
				<h4>{{trans('admin.key')}}</h4>
				<p>{{settings()->keywords}}</p>
			@endif	
				<ul>
						<li><a href="{{settings()->facebook}}"><span></span>{{trans('admin.know_facebook')}}</a></li>
						<li><a href="{{settings()->twitter}}"><span></span>{{trans('admin.know_twitter')}}</a></li>
						<li><a href="{{settings()->insta}}"><span></span>{{trans('admin.know_insta')}}</a></li>
						<li><a href="{{settings()->mail}}"><span></span>{{trans('admin.mail_us_on')}}</a></li>
						<!-- <li><a href="#"><span></span>Handhygeine  consectetur adipisicing elit</a></li>
						<li><a href="#"><span></span>Peri Operative  consectetur adipisicing elit</a></li> -->
					</ul>
			</div>
			</div>
	   </div>
<!-- special -->

@endsection