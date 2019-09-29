<div class="col-md-8 column">

	<div class="events-gridview remove-ext">  

		<div class="row">
			@foreach($events as $event)
			<div class="col-md-6">

				<div class="category-box">

					<div class="category-block">

						<div class="category-img">

					 		<img src="{{"/images/".$event->file_name?:'/img/gallery/img11.jpg'}}" alt="">

							<ul>

								<li class="date">
									<a class="pointer load_page" data-url = "/frontend/event/detail/{{$event->id}}"  title=""><i class="fa fa-calendar-o"></i> 
										{{ \Carbon\Carbon::parse($event->created_at)->format('D/ m/ Y')}}
									</a>
								</li>

								<li class="time"><a class="pointer load_page" data-url = "/frontend/event/detail/{{$event->id}}"  title=""><i class="fa fa-clock-o"></i> {{ \Carbon\Carbon::parse($event->created_at)->format('h:i A')}}</a></li>

							</ul>

						</div>

						<h3><a class="pointer load_page" data-url = "/frontend/event/detail/{{$event->id}}"  title="">{{ucfirst($event->title)}}</a></h3>

						<span><i class="fa fa-map-marker"></i> {{ucfirst($event->address)}}</span>

					</div>						

				</div><!-- EVENTS -->
			</div>
			@endforeach
		</div>

	</div><!-- EVENTS GRID VIEW -->



	<div class="theme-pagination">

		<ul class="pagination">

			<li><a href="#"><i class="fa fa-angle-left"></i></a></li>

			<li><a href="#">1</a></li>

			<li><a href="#">2</a></li>

			<li><a href="#">3</a></li>

			<li><a href="#">4</a></li>

			<li><a href="#">5</a></li>

			<li><a href="#"><i class="fa fa-angle-right"></i></a></li>

		</ul>

	</div><!-- PAGINATION -->
</div>
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