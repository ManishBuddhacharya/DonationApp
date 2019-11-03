<aside class="col-md-4 sidebar column">
	<div class="widget">

		<div class="widget-title"><h4>RECENT BLOG</h4></div>

		<div class="remove-ext">
			@foreach($blogss as $blog)
			<div class="widget-blog">

				<div class="widget-blog-img">
					<img src="{{"/images/".$blog->file_name?:'/img/gallery/img11.jpg'}}" alt="">
				</div>

				<p><a class="pointer load_page" data-url = "/frontend/blog/detail/{{$blog->id}}" title="">{{ucfirst($blog->title)}}</a></p>

				<span><i class="fa fa-calendar-o"></i> {{ \Carbon\Carbon::parse($blog->created_at)->format('D/ F/ Y')}}</span>

			</div><!-- WIDGET BLOG -->
			@endforeach
		</div>						

	</div><!-- RECENT BLOG -->


	<div class="widget">

		<div class="widget-title"><h4>LATEST EVENT</h4></div>

		<div class="animal-event simple">

			<div class="animal-detail">

				<h4><a href="#" title="">{{ucfirst($event->title)}}</a></h4>

				<div class="animal-img"><img src="{{"/images/".$event->file_name?:'/img/gallery/img11.jpg'}}" alt=""><span><strong>{{ \Carbon\Carbon::parse($event->created_at)->format('d')}}</strong>{{ \Carbon\Carbon::parse($event->created_at)->format('M / Y')}}</span></div>

				<ul>

					<li><a href="#" title=""><i class="fa fa-map-marker"></i></a> <span>{{ucfirst($event->address)}}</span></li>

					<li><a href="#" title=""><i class="fa fa-clock-o"></i></a><span>{{ \Carbon\Carbon::parse($event->created_at)->format('h:i:s A')}}</span></li>

				</ul>

			</div>

		</div>

	</div><!-- LATEST EVENT -->

</aside>