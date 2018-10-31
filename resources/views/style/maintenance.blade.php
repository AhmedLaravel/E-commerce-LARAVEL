@include('style.header')
@include('style.message')
<div class="special">
	<div class="container">
		<div class="specia-top">
			<h2 class="btn-primary" > {{settings()->message_maintenance}} </h2>
		</div>
	</div>
</div>
<div class="foot-top">
	<div class="container">
		<div class="col-md-6 s-c">
			<li>
				<div class="fooll">
					<h5>follow us on</h5>
				</div>
			</li>
			<li>
				<div class="social-ic">
					<ul>
						<li><a href="{{url('web')}}/#"><i class="facebok"> </i></a></li>
						<li><a href="{{url('web')}}/#"><i class="twiter"> </i></a></li>
						<li><a href="{{url('web')}}/#"><i class="goog"> </i></a></li>
						<li><a href="{{url('web')}}/#"><i class="inst"> </i></a></li>
							<div class="clearfix"></div>	
					</ul>
				</div>
			</li>
				<div class="clearfix"> </div>
		</div>
		<div class="col-md-6 s-c">
			<div class="stay">
						<div class="stay-left">
							<form>
								<input type="text" placeholder="Enter your email " required="">
							</form>
						</div>
						<div class="btn-1">
							<form>
								<input type="submit" value="join">
							</form>
						</div>
							<div class="clearfix"> </div>
			</div>
		</div>
			<div class="clearfix"> </div>
	</div>
</div>
@include('style.footer')