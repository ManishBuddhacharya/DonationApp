
<div class="col-md-12">
	<div class="col-md-2"></div>
	<div class="col-md-8">
		<div class="login-block mt-15">

			<h5 class="">Login to Donation site</h5>

			<div class="checkout-content mb-15" style="display: block;">

				<p>If you have already register before, please enter your details in the boxes below. If you are a new customer <a href="">click here</a></p>

				<form>

					<div class="row">

						<div class="col-md-6 field">
							<label>Username</label>
							<input type="text" class="form-control">

						</div>

						<div class="col-md-6 field">
							<label>Password</label>
							<input type="password" class="form-control">

						</div>

					</div>

					<div class="widget">
							<div class="quick-message">
								<input class="submit" type="submit" id="submit" value="Login" style="background: #2d695c">
							</div>
						</div>

				</form>

				</div>

		</div>
	</div>
	<div class="col-md-2"></div>

</div>

<script>
	$(document).find('.field input').on('click', function(e){
		$(this).parent().find('label').addClass('fieldTransform');
		$(this).parent().find('label').removeClass('fieldTransformBack');

	});

	$(document).find('.field input').on('blur', function(e){
		let x = $(this).val();
		if (x.length == 0) {
			$(this).parent().find('label').removeClass('fieldTransform');
			$(this).parent().find('label').addClass('fieldTransformBack');
		}
	});
</script>