<header class="header2">
	<div class="topbar">
		<div class="container">
			<div class="header-timer">
				<p>Upcoming Event:</p>
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
			@guest
			<p  class="mr-10 pointer load_page">
				<a href="{{ route('login') }}">
					<i class="fa fa-user pl-15" style="border-left: 2px solid #ccc; "></i>
					<span style="border-right: 2px solid #ccc;" class="pr-10">
						{{ __('Login') }}
					</span>
				</a>
			</p><!--- Login -->

			<p class="mr-10 pointer load_page" >
				<a href="{{ route('register') }}">
					<i class="fa fa-plus"></i>  {{ __('Register') }}
				</a>
			</p><!--- Signup -->
			@else
			<p  class="mr-10 pointer load_page" >
				
				<i class="fa fa-user pl-15" style="border-left: 2px solid #ccc; "></i>
				
			<a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
            </p>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
			@endguest
			</ul>
		</div>
	</div><!--- TOP BAR -->

	<nav class="style1">
		<div class="container">
			<div class="logo">
				<a class="pointer" href="/" data-url="" title=""><img src="assets/images/logo.png" alt=""></a>
			</div><!--- LOGO -->

			<ul>

				<li><a href="/" title="">Home</a></li>
				<li><a class="pointer load_page" data-url="/frontend/organization" title="">Organization Structure</a></li>
				<li><a class="pointer load_page" data-url="/frontend/cause" title="">Causes</a></li>
				<li><a class="pointer load_page" data-url="/frontend/event" title="">Events</a></li>
				<li><a class="pointer load_page" data-url="/frontend/story" title="">Stories</a></li>
				<li class="menu-item-has-children"><a href="#" title="">Media</a>
					<ul>
						<li><a class="pointer load_page" data-url="/frontend/news" title="">News</a></li>
						<li><a class="pointer load_page" data-url="/frontend/gallery" title="">Gallary</a></li>
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
	// $('.load_page').off('click').on('click', function(e){
	// 	let url = $(this).attr('data-url');
	// 	$.ajax({
	// 	    method:'get',
	// 	    url:url,
	// 	    success:function(data)
	// 	    {
	// 	      	$('#section-wrapper').html(data);
	// 	    },
	// 	    error:function(e)
	// 	    {
	// 	      	alert('dsadad');
	// 	    }
	//    });
	// });
</script>