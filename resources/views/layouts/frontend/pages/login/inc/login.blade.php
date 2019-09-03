
<div class="row">
	<div class="col-md-4 col-md-offset-4">
		<div class="login-block mt-15">

			<h5 class="">Login </h5>

			<div class="checkout-content mb-15" style="display: block;">

				<p>If you have already register before, please enter your details in the boxes below. If you are a new customer <a href="">click here</a></p>

				<form method="POST" action="{{ route('login') }}">
                    @csrf

					<div class="row">

						<div class="col-md-12 field">
							<label>Email</label>
							<input type="text" class="form-control" name="email">

						</div>

						<div class="col-md-12 field">
							<label>Password</label>
							<input type="password" class="form-control" name="password">

						</div>

					</div>

					<div class="widget">
							<div class="quick-message">
								<input class="submit" type="submit" id="submit" value="Login" style="background: #2d695c">
							</div>
						</div>
						@if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif

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