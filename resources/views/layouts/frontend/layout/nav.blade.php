<header class="header2">
	<div class="topbar">
		<div class="container">
			<div class="header-timer">
				<p>Upcoming Prayers:</p>
				<ul class="headercounter">
					<li> <span class="days">00</span>
					<p class="days_ref">DAYS</p>
					</li>
					<li> <span class="hours">00</span>
					<p class="hours_ref">HOURS</p>
					</li>
					<li> <span class="minutes">00</span>
					<p class="minutes_ref">MINTS</p>
					</li>
					<li> <span class="seconds">00</span>
					<p class="seconds_ref">SECS</p>
					</li>
				</ul>
			</div>

			<p><i class="fa fa-mobile"></i> 24/7 Support: 123-456-7890</p><!--- CONTACT -->
			<p><i class="fa fa-envelope"></i>  Youremail@yourdomain.com</p><!--- EMAIL -->
			<ul class="social-media">
				<li><a title="" href="#"><i class="fa fa-linkedin"></i></a></li>
				<li><a title="" href="#"><i class="fa fa-google-plus"></i></a></li>
				<li><a title="" href="#"><i class="fa fa-twitter"></i></a></li>
				<li><a title="" href="#"><i class="fa fa-facebook"></i></a></li>
			</ul>
		</div>
	</div><!--- TOP BAR -->

	<nav class="style1">
		<div class="container">
			<div class="logo">
				<a class="pointer" href="/" data-url="" title=""><img src="assets/images/logo.png" alt=""></a>
			</div><!--- LOGO -->

			<ul>

				<li><a class="pointer load_page" data-url="/" title="">Home</a></li>
				<li><a class="pointer load_page" data-url="/frontend/organization" title="">Organization Structure</a></li>
				<li><a class="pointer load_page" data-url="/frontend/story" title="">Causes</a></li>
				<li><a class="pointer load_page" data-url="/frontend/event" title="">Events</a></li>
				<li><a class="pointer load_page" data-url="/frontend/stories" title="">Stories</a></li>
				<li class="menu-item-has-children"><a href="#" title="">Media</a>
					<ul>
						<li><a class="pointer load_page" data-url="/frontend/news" title="">News</a></li>
						<li><a class="pointer load_page" data-url="/frontend/gallary" title="">Gallary</a></li>
				    </ul>
				</li>

				</li>
				<li><a class="pointer load_page" data-url="/frontend/about" title="">About</a></li>
				<li><a class="pointer load_page" data-url="/frontend/contact" title="">Contact</a></li>
			</ul>
		</div>
	</nav>
</header>

<script>
	$('.load_page').off('click').on('click', function(e){
		let url = $(this).attr('data-url');
		$.ajax({
		    method:'get',
		    url:url,
		    success:function(data)
		    {
		      	$('#section-wrapper').html(data);
		    },
		    error:function(e)
		    {
		      	alert('dsadad');
		    }
	   });
	});
</script>