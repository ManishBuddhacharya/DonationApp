<section>

	<div class="block">

		<div class="container">

			<div class="row">

				<div class="title2">

					<h2>Our <span>STORIES</span></h2>

				</div>



				<div class="col-md-8 column">

					<div class="remove-ext">

						<div class="row">
						@foreach($stories as $story)
							@if($loop->iteration > 2)
								@continue
							@endif
							<div class="col-md-6">

								<div class="story">

									<div class="image">

										<img src="{{"/images/".$story->file_name?:'/img/gallery/img11.jpg'}}" alt="">

										<a class="pointer load_page" data-url = "/frontend/story/detail/{{$story->id}}" title=""><i class="fa fa-link"></i></a>

									</div>

									<div class="story-detail">

										<span class="date"><i class="fa fa-calendar-o"></i> {{ \Carbon\Carbon::parse($story->created_at)->format('F')}}, {{ \Carbon\Carbon::parse($story->created_at)->format('d')}}, {{ \Carbon\Carbon::parse($story->created_at)->format('Y')}}</span>

										<h3><a href="church-story-single.html" title="">{{ucfirst($story->title)}}</a></h3>

										<span><i class="fa fa-user"></i>{{ucwords($story->user()->name)}}</span>

									</div>

								</div>
							</div>
						@endforeach

						</div>

					</div>

				</div>



				<div class="col-md-4 column">

					<div class="blog-listing">
						@foreach($stories as $story)
						@if($loop->iteration <= 2)
								@continue
							@endif
						<div class="blog-list">

							<a class="pointer load_page" data-url = "/frontend/story/detail/{{$story->id}}" title="">
								<img src="{{"/images/".$story->file_name?:'/img/gallery/img11.jpg'}}" alt=""></a>

							<h3><a class="pointer load_page" data-url = "/frontend/story/detail/{{$story->id}}" title="">{{ucfirst($story->title)}}</a></h3>

							<ul>

								<li><i class="fa fa-tag"></i><a href="#" title="">Story</a> / <a href="#" title="">{{ \Carbon\Carbon::parse($story->created_at)->format('Y')}}</a> </li>

								<li><i class="fa fa-calendar-o"></i> {{ \Carbon\Carbon::parse($story->created_at)->format('F')}}, {{ \Carbon\Carbon::parse($story->created_at)->format('d')}}</li>								

							</ul>
						</div>
						@endforeach
						<a class="pointer load_page" data-url="/frontend/story" title=""><i class="fa fa-angle-double-right"></i></a>

					</div>

				</div>



			</div>

		</div>

	</div>

</section>

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