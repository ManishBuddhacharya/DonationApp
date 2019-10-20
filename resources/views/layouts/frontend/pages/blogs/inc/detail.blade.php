<div class="col-md-8 column">

	<div class="single-page">

		<img src="{{"/images/".$blog->file_name?:'/img/gallery/img11.jpg'}}" alt="">

		<h2>{{ucfirst($blog->title)}}</h2>

		<div class="meta">

			<ul>

				<li><i class="fa fa-reply"></i> Posted In <a href="#" title="">Blog</a></li>

				<li><i class="fa fa-calendar-o"></i> {{ \Carbon\Carbon::parse($blog->created_at)->format('F')}}, {{ \Carbon\Carbon::parse($blog->created_at)->format('d')}}, {{ \Carbon\Carbon::parse($blog->created_at)->format('Y')}}</li>

				<li><i class="fa fa-user"></i> <a href="#" title="">{{ucwords($blog->user()->name)}}</a></li>

			</ul>

			<img src="{{"/images/".$blog->user()->profile_img?:'/img/gallery/img11.jpg'}}" alt="">

		</div><!-- POST META -->

	</div><!-- SERMON SINGLE -->

	{!! $blog->content !!}

	<div class="share-this">

		<h5><i class="fa fa-share"></i> SHARE THIS Blog</h5>

		<ul class="social-media">

			<li><a href="#" title=""><i class="fa fa-linkedin"></i></a></li>

			<li><a href="#" title=""><i class="fa fa-google-plus"></i></a></li>

			<li><a href="#" title=""><i class="fa fa-twitter"></i></a></li>

			<li><a href="#" title=""><i class="fa fa-facebook"></i></a></li>

		</ul>				

	</div><!-- SHARE THIS -->

	@include('layouts.frontend.pages.blogs.inc.comment')

</div>