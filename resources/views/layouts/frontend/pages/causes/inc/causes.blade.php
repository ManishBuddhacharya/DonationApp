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

			<div class="hover-in">

				<ul class="sermon-media">

					<li><a href="http://vimeo.com/44867610" data-rel="prettyPhoto" title=""><i class="fa fa-film"></i></a></li>

					<li><a title=""><i class="audio-btn fa fa-headphones"></i>

						<div class="audioplayer"><div id="mep_0" class="mejs-container svg mejs-audio" style="width: 400px; height: 30px;"><div class="mejs-inner"><div class="mejs-mediaelement"><audio src="sermon.mp3"></audio></div><div class="mejs-layers"><div class="mejs-poster mejs-layer" style="display: none; width: 400px; height: 30px;"></div></div><div class="mejs-controls"><div class="mejs-button mejs-playpause-button mejs-play"><button type="button" aria-controls="mep_0" title="Play/Pause" aria-label="Play/Pause"></button></div><div class="mejs-time mejs-currenttime-container"><span class="mejs-currenttime">00:00</span></div><div class="mejs-time-rail"><span class="mejs-time-total"><span class="mejs-time-buffering" style="display: none;"></span><span class="mejs-time-loaded" style="width: 180px;"></span><span class="mejs-time-current" style="width: 0px;"></span><span class="mejs-time-handle" style="left: -5px;"></span><span class="mejs-time-float"><span class="mejs-time-float-current">00:00</span><span class="mejs-time-float-corner"></span></span></span></div><div class="mejs-time mejs-duration-container"><span class="mejs-duration">03:00</span></div><div class="mejs-button mejs-volume-button mejs-mute"><button type="button" aria-controls="mep_0" title="Mute Toggle" aria-label="Mute Toggle"></button></div><div class="mejs-horizontal-volume-slider"><div class="mejs-horizontal-volume-total"></div><div class="mejs-horizontal-volume-current"></div><div class="mejs-horizontal-volume-handle"></div></div></div><div class="mejs-clear"></div></div></div><span class="cross">X</span></div>

					</a></li>

					<li><a target="_blank" href="http://themes.webinane.com/deeds/test.doc" title=""><i class="fa fa-download"></i></a></li>

					<li><a target="_blank" href="http://themes.webinane.com/deeds/test.pdf" title=""><i class="fa fa-book"></i></a></li>

				</ul>

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