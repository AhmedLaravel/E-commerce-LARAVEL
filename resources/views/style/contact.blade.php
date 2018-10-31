@extends('style.index')
@section('content')
<div class="main">
      <div class="contact_top">
		<div class="container">
			<div class="row">
				<!-- <div class="col-md-7 map">
				  <div class="map">
					<iframe width="100%" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.co.in/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Lighthouse+Point,+FL,+United+States&amp;aq=4&amp;oq=light&amp;sll=30.017006,31.213451&amp;sspn=30.017006,31.213451&amp;ie=UTF8&amp;hq=&amp;hnear=Lighthouse+Point,+Broward,+Florida,+United+States&amp;t=m&amp;z=14&amp;ll=30.017006,31.213451&amp;output=embed"></iframe><br><small><a href="https://maps.google.co.in/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=Lighthouse+Point,+FL,+United+States&amp;aq=4&amp;oq=light&amp;sll=30.017006,31.213451&amp;sspn=30.017006,31.213451&amp;ie=UTF8&amp;hq=&amp;hnear=Lighthouse+Point,+Broward,+Florida,+United+States&amp;t=m&amp;z=14&amp;ll=30.017006,31.213451" style="color:#666;text-align:left;font-size:12px"></a></small>
				  </div>
				</div> -->
				<div class="col-md-5 tes">
					<p class="m_8">{{settings()->description}}</p>
					<div class="address">
				                <p>{{settings()->address1}},</p>
						   		<p>{{settings()->address2}},</p>
						   		<p>{{settings()->country}}</p>
				   		<p>Phone : {{settings()->phone}},</p>
				   		<p>Fax : {{settings()->fax}},</p>
				 	 	<p>Email : <a href="{{url('http://'.settings()->mail)}}">{{settings()->mail}} </a></p>
				   </div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 contact">
				  <form method="post" action="{{url('contact/us')}}">
				  	{{csrf_field()}}
					<div class="to">
                     	<input type="text" name="name" placeholder="Name" class="text" value="{{old('name')}}" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Name';}">
					 	<input type="text" placeholder="Email" name = 'email' class="text" value="{{old('email')}}" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email';}">
					 	<input type="text" name="subject" placeholder="Subject" class="text" value="{{old('subject')}}" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Subject';}">
					</div>
					<div class="text">
	                   <textarea value="{{old('message')}}:" placeholder="Message" name="message" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Message';}">Message:</textarea>
	                   <div class="form-submit">
			           <input name="submit" type="submit" id="submit" value="Submit"><br>
			           </div>
	                </div>
	                <div class="clear"></div>
                   </form>
			     </div>
		    </div>
	     </div>
	   </div>
	  </div>
@endsection