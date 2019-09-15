<div class="col-md-8 column">

	<div class="remove-ext">
		@foreach($stories as $story)
		<div class="col-md-6">

			<div class="story">

				<div class="image">

					<img src="{{"/images/".$story->file_name?:'/img/gallery/img11.jpg'}}" alt="">

					<a class="pointer load_page" data-url = "/frontend/story/detail/{{$story->id}}"  title=""><i class="fa fa-link"></i></a>

				</div>

				<div class="story-detail">

					<span class="date"><i class="fa fa-calendar-o"></i> {{ \Carbon\Carbon::parse($story->created_at)->format('F')}}, {{ \Carbon\Carbon::parse($story->created_at)->format('d')}}, {{ \Carbon\Carbon::parse($story->created_at)->format('Y')}}</span>

					<h3><a class="pointer load_page" data-url = "/frontend/story/detail/{{$story->id}}"  title="">{{ucfirst($story->title)}}</a></h3>

					<span><i class="fa fa-user"></i> {{ucwords($story->user()->name)}}</span>

				</div>

			</div>
		</div>
		@endforeach
	</div>



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