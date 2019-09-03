
<div class="col-md-12">
	<div class="col-md-2"></div>
	<div class="col-md-8">
		<div class="shipping-address login-block mt-15" style="display: block;">

			<h5 class="">Register Account</h5>

			<div class="checkout-content mb-15" style="display: block;">

				<form id="form_register">

					<div class="row">
						<div class="col-md-4 field">
							<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
							<label>First Name</label>
							<input type="text" name="fname" class="form-control">
						</div>

						<div class="col-md-4 field">
							<label>Middle Name</label>
							<input type="text" name="mname" class="form-control">

						</div>

						<div class="col-md-4 field">
							<label>Last Name</label>
							<input type="text" name="lname" class="form-control">

						</div>


						<div class="col-md-6 field">
							<label>Phone No</label>
							<input type="text" name="phone" class="form-control">

						</div>

						<div class="col-md-6 field">
							<label>Address</label>
							<input type="text" name="address" class="form-control">

						</div>

						<div class="col-md-6 field">
							<label>Username</label>
							<input type="text" name="username" class="form-control">

						</div>

						<div class="col-md-6 field">
							<label>Email</label>
							<input type="email" name="email" class="form-control">

						</div>

						<div class="col-md-6 field">
							<label>Password</label>
							<input type="Password" name="password" class="form-control">

						</div>

						<div class="col-md-6 field">
							<label>Confirm Password</label>
							<input type="Password" name="password_confirmation" class="form-control">

						</div>
						<div class="widget col-md-12">
							<div class="quick-message">
								<input class="submit" type="submit" id="register_user" value="Register" style="background: #2d695c">
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

	$(document).off('click', '#register_user').on('click','#register_user', function(e){
		e.preventDefault();
	    let data = $('#form_register').serialize();
	    saveDataFromModal({
        url : '/register',
        formData: data,
        },function(data){
            console.log(data.length);
            toastr.success("User registered Successfully.");
        },
        function(data){
	            console.log("error : "+data);
	            toastr.info("Please verify from your mail to log in to system.");
        });
    }); 
</script>