
<section>

	<div class="block remove-gap">

		<div class="container">

			<div class="row">
				<div class="title2" style="margin-top: 45px;">

					<h2>OUR <span>RECENT NEWS</span></h2>

				</div>
				@foreach($news as $n)
					<div class="col-md-4 column">

						<div class="service-block">

							<div class="service-image">

								<img src="{{"/images/".$n->file_name?:'/img/gallery/img11.jpg'}}" alt="">

								<i class="fa fa-codepen"></i>

							</div>

							<h3>{{ucfirst($n->title)}}</h3>

							<a class="pointer load_page" data-url = "/frontend/news/detail/{{$n->id}}" title="">READ MORE</a>

						</div>
					</div>
				@endforeach
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