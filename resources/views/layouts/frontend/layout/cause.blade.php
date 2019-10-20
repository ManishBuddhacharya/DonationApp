<section>

	<div class="block whitish">

	<div class="parallax" style="background:url(assets/images/parallax5.jpg);"></div>

		<div class="container">

			<div class="row">

				<div class="col-md-8 column">

					<div class="welcome">

						<h1><i class="fa fa-recycle"></i>{{ucfirst($cause->title)}}</h1>

						<p class="line-clamp">{{strip_tags($cause->content)}}</p>

						<a title="" class="pointer load_page" data-url = "/frontend/cause/detail/{{$cause->id}}" >READ MORE</a>

					</div>

				</div>

				<div class="col-md-4 column">

					<div class="survey">

						<h3>DONATION</h3>

						<div class="needed">

							<span><i class="fa fa-bank"></i></span>

							<h5>$ {{$cause->goal}}</h5>

							<h6>NEEDED</h6>

						</div>

						<div class="survey-report">

							<span><i class="fa fa-ambulance"></i></span>

							<h5>$ {{$cause->goal}}</h5>

							<h6>Total</h6>

						</div>

						<div class="survey-report">

							<span><i class="fa fa-delicious"></i></span>

							<h5>$ {{$cause->transactions->sum('amount')?:0}}</h5>

							<h6>Raised</h6>

						</div>

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