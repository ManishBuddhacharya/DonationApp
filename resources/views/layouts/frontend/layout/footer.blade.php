<style>
	.line-clamp-blog{
	    display: -webkit-box;
	    -webkit-line-clamp: 2;
	    -webkit-box-orient: vertical;  
	    overflow: hidden;"
	}
</style>
<footer>

	<div class="block blackish">

	<div class="parallax" style="background:url(/assets/images/parallax5.jpg);"></div>

		<div class="container">

			<div class="row"> 

				<div class="col-md-4">

					<div class="widget">

						<div class="about">

							<img src="/assets/images/logo.png" alt="">

							<span>We Give Best Services</span>

							<p>Homemade cream cheese mints These are amazing! Made them last Christmas!!- must try!</p>

							<div class="contact">

								<ul>

									<li><span><i class="fa fa-phone"></i>Phone :</span> ( +185 557 89 89 ) ( +185 557 89 89 )</li>

									<li><span><i class="fa fa-envelope"></i>Email:</span> Contactchurch@simple.com</li>

									<li><span><i class="fa fa-home"></i>Address:</span> Home Fronts 27# street 7 Road Green</li>

								</ul>

							</div>							

							<ul class="social-media">

								<li><a href="#" title=""><i class="fa fa-linkedin"></i></a></li>

								<li><a href="#" title=""><i class="fa fa-google-plus"></i></a></li>

								<li><a href="#" title=""><i class="fa fa-twitter"></i></a></li>

								<li><a href="#" title=""><i class="fa fa-facebook"></i></a></li>

							</ul>															

						</div>

					</div>

				</div><!-- ABOUT WIDGET -->

				<div class="col-md-4">

					<div class="widget">

						<div class="widget-title"><h4>Quick Message</h4></div>

						<div class="quick-message">

							<div id="message"></div>

							<form method="post" action="https://html.webinane.com/deeds/contact.php" name="contactform" id="contactform">

								<input name="name" class="half-field form-control" type="text" id="name" placeholder="Name">

								<input name="email" class="half-field form-control" type="text" id="email" placeholder="Email">

								<textarea name="comments" class="form-control" id="comments" placeholder="Description"></textarea>

								<input class="submit" type="submit" id="submit" value="SUBMIT">

							</form><!--- FORM -->

						</div>

					</div>

				</div><!-- QUICK MESSAGE WIDGET -->



				<div class="col-md-4">

					<div class="widget">

						<div class="widget-title"><h4>Recent Blog</h4></div>

						<div class="remove-ext">
							{{-- @foreach($blogs as $blog)
							<div class="widget-blog">

								<div class="widget-blog-img"><img src="{{"/images/".$blog->file_name?:'/img/gallery/img11.jpg'}}" alt=""></div>

								<h6><a class="pointer load_page" data-url = "/frontend/blog/detail/{{$blog->id}}" title=""> {{ucfirst($blog->title)}}</a></h6>

								<p class="line-clamp-blog">{{strip_tags($blog->content)}}!</p>

								<span><i class="fa fa-calendar-o"></i> {{ \Carbon\Carbon::parse($blog->created_at)->format('D/ F/ Y')}}</span>
							</div><!-- WIDGET BLOG -->
							@endforeach --}}
						</div>

						

					</div>

				</div><!-- RECENT BLOG -->				

			</div>

		</div>

	</div>

</footer>


</div>

<script type="text/javascript">
	$(document).ready(function() {		
		$(".featured-caro").owlCarousel({
			autoPlay: true,
			rewindSpeed : 3000,
			slideSpeed:2000,
			loop: true,
			items : 1,
			animateOut: 'fadeOut',
    		animateIn: 'fadein',
			itemsDesktop : [1199,2],
			itemsDesktopSmall : [979,2],
			itemsTablet : [768,2],
			itemsMobile : [479,1],
			navigation : true
		}); 
		$('.image-link').magnificPopup({type:'image'});
	});	

	$('audio,video').mediaelementplayer();
</script>
</body>
</html>