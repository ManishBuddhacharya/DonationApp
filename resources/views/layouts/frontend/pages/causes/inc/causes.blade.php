<div class="col-md-8 column">

<div class="latest-sermons remove-ext">
	@foreach($causes as $cause)
	<div class="sermon">
		<div class="row">

			<div class="col-md-4">

				<div class="image">

					<img src="{{"/images/".$cause->file_name?:'/img/gallery/img11.jpg'}}" alt="">

					<a class="pointer load_page" data-url = "/frontend/cause/detail/{{$cause->id}}"  title=""><i class="fa fa-link"></i></a>

				</div>

			</div>

			<div class="col-md-8">

				<h3><a class="pointer load_page" data-url = "/frontend/cause/detail/{{$cause->id}}" title="">{{ucfirst($cause->title)}}</a></h3>

				<span><i class="fa fa-calendar-o"></i> {{ \Carbon\Carbon::parse($cause->created_at)->format('D/ F/ Y')}}</span>

				<p class="line-clamp">{{strip_tags($cause->content)}}</p>
				

			</div>
		</div>
	</div><!-- SERMON -->
	@endforeach
</div><!-- LATEST SERMONS -->

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