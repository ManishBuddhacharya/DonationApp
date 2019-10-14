<style>

	.image-link:hover {
		cursor: zoom-in;
	  	-webkit-filter: grayscale(100%) blur(2px);
	  	filter: grayscale(100%) blur(2px);
	  	transition: .4s ease-in-out;
	  	cursor: pointer;
	}
</style>

<section>

	<div class="block">

		<div class="container">

			<div class="row">

				<div class="col-md-12">

					<div class="remove-ext">

						<div class="row">
							@foreach($images as $image)
							<div class="col-md-4" >
								<div class="gallery" style="position: relative;">
									<img class="image-link" src="{{"/images/".$image->file_name?:'/img/gallery/img11.jpg'}}"  alt=""> 
									 <a style="position: absolute; right: 45%; top: 40%; font-size: 50px;" class="image-popup" href="{{"/images/".$image->file_name?:'/img/gallery/img11.jpg'}}"><i class="icon mdi mdi-eye"></i></a>

								</div><!-- GALLERY ITEM -->

							</div>
							@endforeach
						</div>						

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

			</div>

		</div>

	</div>

</section>

<script>
	$('.image-popup').magnificPopup({
	    type: 'image'
	    // other options
	});

</script>