
<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<div class="shipping-address login-block mt-15" style="display: block;">

			<h5 class="">Register Account</h5>

			<div class="checkout-content mb-15" style="display: block;">

				<form method="POST" action="{{ route('register') }}">

					<div class="row">
						@csrf
						<div class="col-md-12 field">
							<label>Name</label>
							<input type="text" class="form-control" name="name">
							@error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
						</div>

						<div class="col-md-6 field">
							<label>Address</label>
							<input type="text" class="form-control" name="address">
							@error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
						</div>
						<div class="col-md-6 field">
							<label>Phone No</label>
							<input type="text" class="form-control" name="phone">
							@error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
						</div>


						<div class="col-md-12 field">
							<label>Email</label>
							<input type="email" class="form-control" name="email">
							@error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
						</div>

						<div class="col-md-6 field">
							<label>{{ __('Password') }}</label>
							<input type="Password" class="form-control" name="password">
							@error('password')
	                            <span class="invalid-feedback" role="alert">
	                                <strong>{{ $message }}</strong>
	                            </span>
	                        @enderror
						</div>

						<div class="col-md-6 field">
							<label>Confirm Password</label>
							<input type="Password" class="form-control" name="password_confirmation">

						</div>
						<div class="widget col-md-12">
							<div class="quick-message">
								<button class="btn btn-md submit" type="submit" id="submit" style="background: #2d695c; color: #fff">Register</button>
							</div>
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