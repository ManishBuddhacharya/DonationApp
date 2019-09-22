<div class="col-md-8 column">

	<div class="remove-ext">
		@foreach($news as $n)

		<div class="blog-post">

			<div class="row">

				<div class="col-md-5">

					<div class="image">

						<img src="{{"/images/".$n->file_name?:'/img/gallery/img11.jpg'}}" alt="">

						<a class="pointer load_page" data-url = "/frontend/news/detail/{{$n->id}}"><i class="fa fa-link"></i></a>

					</div>

				</div>

				<div class="col-md-7">

					<div class="blog-detail">

						<h3><a class="pointer load_page" data-url = "/frontend/news/detail/{{$n->id}}" title="">{{ucfirst($n->title)}}</a></h3>

						<p class="line-clamp">{{strip_tags($n->content)}}</p>

						<span><i class="fa fa-calendar-o"></i> {{ \Carbon\Carbon::parse($n->created_at)->format('F')}}, {{ \Carbon\Carbon::parse($n->created_at)->format('d')}}, {{ \Carbon\Carbon::parse($n->created_at)->format('Y')}}</span>

					</div>

				</div>

			</div>

		</div><!-- BLOG POST -->
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