@if(request()->segment(1) != 'checkout')
<div class="foot-top">
	<div class="container">
		<div class="col-md-6 s-c">
			<li>
				<div class="fooll">
					<h5>{{trans('admin.follow_us')}}</h5>
				</div>
			</li>
			<li>
				<div class="social-ic">
					<ul>
						<li><a href="{{url(settings()->facebook)}}"><i class="facebok"> </i></a></li>
						<li><a href="{{url(settings()->twitter)}}"><i class="twiter"> </i></a></li>
						<li><a href="{{url(settings()->insta)}}"><i class="inst"> </i></a></li>
							<div class="clearfix"></div>	
					</ul>
				</div>
			</li>
				<div class="clearfix"> </div>
        <span><p>{{trans('admin.hope')}} <i class="fa fa-heart"></i><i class="fa fa-heart"></i><i class="fa fa-heart"></i> </p></span>
		</div>
		<div class="col-md-6 s-c">
			<div class="stay">
						<div class="stay-left">
							<form action="{{url('subscribe')}}" method="POST">
                {{csrf_field()}}
								<input name="email" type="text" placeholder="{{trans('admin.email')}} " required="">
                <div class="btn-1">
                    <input class="btn btn-primary" type="submit" value="{{trans('admin.subscribe')}}">
    						</div>
              </form>
            </div>
							<div class="clearfix"> </div>
			</div>
		</div>
			<div class="clearfix"> </div>
	</div>
</div>
</div>
<a href="{{url('web')}}/#" id="toTop" style="display: block;"><span id="toTopHover" style="opacity: 0;"></span> <span id="toTopHover" style="opacity: 0;"> </span></a>
@endif

<!-- <script type="text/javascript">
        //////////// Stripe Token Handler /////////////////////////
       

        //////////// Stripe Token Handler /////////////////////////
        // Create a Stripe client.
        (function(){

            var stripe = Stripe('pk_test_DURTfm0XbW8gb114Mu2myjQL');

            // Create an instance of Elements.
            var elements = stripe.elements();

            // Custom styling can be passed to options when creating an Element.
            // (Note that this demo uses a wider set of styles than the guide below.)
            var style = {
              base: {
                color: '#32325d',
                lineHeight: '18px',
                fontFamily: '"Roboto","Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                  color: '#aab7c4'
                }
              },
              invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
              }
            };


            // Create an instance of the card Element.
            var card = elements.create('card', {
                style: style,
                hidePostalCode: true,
            });

            // Add an instance of the card Element into the `card-element` <div>.
            card.mount('#card-element');

            // Handle real-time validation errors from the card Element.
            card.addEventListener('change', function(event) {
              var displayError = document.getElementById('card-errors');
              if (event.error) {
                displayError.textContent = event.error.message;
              } else {
                displayError.textContent = '';
              }
            });

            // Handle form submission.
            var form = document.getElementById('payment-form');
            if (form) {

                form.addEventListener('submit', function(event) {
                  event.preventDefault();

                  document.getElementById('complete_order').disabled = true;

                  var optiens={
                name: document.getElementById('billing_first_name').value,
                address_line1: document.getElementById('billing_address_1').value,
                address_city: document.getElementById('billing_city').value,
                address_state: document.getElementById('billing_state').value,
                address_zip: document.getElementById('billing_postcode').value,
            }

                  stripe.createToken(card, optiens).then(function(result) {
                    if (result.error) {
                      // Inform the user if there was an error.
                      var errorElement = document.getElementById('card-errors');
                      errorElement.textContent = result.error.message;
                      document.getElementById('complete_order').disabled = false;
                    } else {
                      // Send the token to your server.
                      stripeTokenHandler(result.token);
                    }
                  });
                });
            }
             function stripeTokenHandler(token) {
          // Insert the token ID into the form so it gets submitted to the server
          var form = document.getElementById('payment-form');
          var hiddenInput = document.createElement('input');
          hiddenInput.setAttribute('type', 'hidden');
          hiddenInput.setAttribute('name', 'stripeToken');
          hiddenInput.setAttribute('value', token.id);
          form.appendChild(hiddenInput);

          // Submit the form
          form.submit();
        }
        })();
</script> -->
<script type="text/javascript">
    $(document).ready(function(){
      @if(old('billing_country'))
        $.ajax({
              url: "{{url('checkout')}}",
              type:'get',
              dataType:'html',
              data:{billing_country:"{{old('billing_country')}}",select:"{{old('billing_city')}}"},
              success: function(data){
                $('.city').html(data);
              }
          });
      @endif
    });
    
    $(document).ready(function(){
      $(document).on('change','.billing_country',function(){
        var country = $('.billing_country option:selected').val();
        if(country > 0){
          $.ajax({
              url: "{{url('checkout')}}",
              type:'get',
              dataType:'html',
              data:{billing_country:country,select:''},
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
  <script type="text/javascript">
    var modal = document.getElementById('myModal');
    // Get the image and insert it inside the modal - use its "alt" text as a caption
    var img = document.getElementById('myImg');
    var modalImg = document.getElementById("img01");
    var captionText = document.getElementById("caption");
    img.onclick = function(){
        modal.style.display = "block";
        modalImg.src = this.src;
        captionText.innerHTML = this.alt;
    }

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() { 
      modal.style.display = "none";
    }
  </script>
  <script type="text/javascript">
    var slideIndex = 1;
    showSlides(slideIndex);

    // Next/previous controls
    function plusSlides(n) {
      showSlides(slideIndex += n);
    }

    // Thumbnail image controls
    function currentSlide(n) {
      showSlides(slideIndex = n);
    }

    function showSlides(n) {
      var i;
      var slides = document.getElementsByClassName("mySlides");
      var dots = document.getElementsByClassName("dot");
      if (n > slides.length) {slideIndex = 1} 
      if (n < 1) {slideIndex = slides.length}
      for (i = 0; i < slides.length; i++) {
          slides[i].style.display = "none"; 
      }
      for (i = 0; i < dots.length; i++) {
          dots[i].className = dots[i].className.replace(" active", "");
      }
      slides[slideIndex-1].style.display = "block"; 
      dots[slideIndex-1].className += " active";
    }
  </script>
</body>
</html>