
<div class="col-md-12 column mt-15 mb-15">
	<div class="tab-style">

		<ul class="nav nav-tabs mr-10" id="myTab2" style="width: 24%; display: inline; margin-top: 3px;">

			<li class="active width-100"><a data-toggle="tab" href="#tab1">Profile</a></li>

			<li class=" width-100"><a data-toggle="tab" href="#tab2">Setting</a></li>

			<!-- <li class=" width-100"><a data-toggle="tab" href="#tab3">TAB BUTTON 3</a></li> -->

		</ul>

		<div class="tab-content no-padding" id="myTabContent2" style="width: 75%; display: inline;">

			<div id="tab1" class="tab-pane fade active in">

				<div class="team-single border-none">

					<div class="member-img p-20" style="width: 40%;">

						<img class="no-padding dropzone" src="assets/images/resource/team-single.jpg" alt="">

					</div>



					<div class="team-detail" style="width: 60%;">

						<h3>JANE BIRKIN <span><i id="editProfile" class="icon fa fa-edit pull-right pointer"></i></span> </h3>

						<ul class="team-list" id="profileDetail">

							<li><i class="fa fa-phone"></i> (800) 123.456.7890 </li>

							<li><i class="fa fa-home"></i> WeStand Eaton Square 489, London</li>

							<li><i class="fa fa-user"></i> Username</li>

							<li><i class="fa fa-envelope"></i> jane@partyname.com</li>

						</ul>
						<div id="profile_form" class="checkout-content mb-15 p-15" style="display: none;">
							<form class="mt-0">
								<div class="row">
									<div class="col-md-4 no-right-pad field">
										<label for="fname">First Name</label>
										<input type="text" name="fname" id="fname" value="Manish" class="form-control">
									</div>
									<div class="col-md-4 field">
										<label for="mname">Middle Name</label>
										<input type="text" name="mname" id="mname" class="form-control">
									</div>
									<div class="col-md-4 no-left-pad field">
										<label for="lname">Last Name</label>
										<input type="text" name="lname" id="lname" value="Buddhacharya" class="form-control">
									</div>

									<div class="col-md-12 field">
										<label for="phone">Phone No:</label>
										<input type="text" name="phone" id="phone" class="form-control">
									</div>

									<div class="col-md-12 field">
										<label for="addr">Address</label>
										<input type="text" name="addr" id="addr" class="form-control">
									</div>

									<div class="col-md-12 field">
										<label for="username">Username</label>
										<input type="text" name="username" id="username" class="form-control">
									</div>

									<div class="col-md-12 field">
										<label for="email">Email</label>
										<input type="text" name="email" id="email" class="form-control">
									</div>

								</div>

								<div class="widget">
										<div class="quick-message">
											<input class="submit" type="submit" id="submit" value="Reset password" style="background: #2d695c">
											<input class="submit pull-right" type="submit" id="cancel_edit_profile" value="Cancel" style="background: #33383a">
										</div>
									</div>

							</form>

						</div>
					</div>

				</div>

			</div>

			<div id="tab2" class="tab-pane fade">

				<div class="col-md-12 no-padding">
					<div class="login-block">

						<h5 class="">Change Password</h5>

						<div class="checkout-content mb-15" style="display: block;">

							<p>Note: After changing password you will be logged out of the sytem.</p>

							<form>

								<div class="row">
									<div class="col-md-12 field">
										<label>Old Password</label>
										<input type="password" class="form-control">
									</div>

									<div class="col-md-12 field">
										<label>New Password</label>
										<input type="password" class="form-control">
									</div>

									<div class="col-md-12 field">
										<label>Confirm Password</label>
										<input type="password" class="form-control">
									</div>

								</div>

								<div class="widget">
										<div class="quick-message">
											<input class="submit" type="submit" id="submit" value="Reset password" style="background: #2d695c">
										</div>
									</div>

							</form>

						</div>

					</div>
				</div>

			</div>



			<div id="tab3" class="tab-pane fade">

				<p>Donec et libero quis erat commodo suscipit. Mae elit a,  eleifend leo. Phasellus ut phitra mi, ctor diam. id Suus arciet spendisse rhoncus id arcet porta akn. Aenean blandit isum, pharetrnisi vesti bulum ornare. Lore ipsum dolo stamet cons ctetur adipiscing elit. Duis non sceleri sque est, quis alquam ligula. Aenean blandit isum, pharetrnisi vesti bulum ornare.</p>

				<div class="space"></div>

				<ul>

					<li><i class="fa fa-check-square-o"></i> Spendisse rhoncus id arcet porta akn. Aenean blandit ipsum, pharetrnisi vesti.</li>

					<li><i class="fa fa-check-square-o"></i> Loriem ipsum dolo stamet cons ctetur adipiscing elit. </li>

					<li><i class="fa fa-check-square-o"></i> Sed ut perspiciatis unde omnis iste natus error sit volm accusant.</li>

					<li><i class="fa fa-check-square-o"></i> Aenean blandit isum, pharetrnisi vesti bulum ornare.</li>

				</ul>

			</div>

		</div>

	</div><!-- TABS STYLE -->

</div>

<script>
	$(document).ready(function(e){
		Dropzone.autoDiscover = false;
	    var myDropzone = new Dropzone(".dropzone", { 
	        url: "http://localhost:3000/profile/upload",
	        success: function(file, response){
	            console.log(response);
	            const id = localStorage.getItem('userID');
	            const data = {
	                ['path']: response.path
	            }
	            axios.put('http://localhost:3000/profile/upload/'+id, data)
	            .then(function(response) {
	                console.log(response.data.error);
	                if (!response.data.error) {
	                    toastr.options = {
	                        "closeButton": true
	                    };
	                    toastr.success("Profile Picture updated Successfully.");
	                    readyProfile();
	                }
	            });
	        }
	    });
	})
	$('#editProfile').on('click', function(e){
		floatLabel();
		$('#profileDetail').hide();
		$('#profile_form').show();
		$(this).parent().parent().hide();
	})

	$('#cancel_edit_profile').on('click', function(e){
		e.preventDefault();
		$('#profileDetail').show();
		$('#profile_form').hide();
		$('#editProfile').parent().parent().show();
	})

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

	function floatLabel(){
		let x = $('.field input').val();
		$('.field input').each(function( index ) {
		  console.log($(this));
			if ($(this).val().length == 0) {
				$(this).parent().find('label').removeClass('fieldTransform');
				$(this).parent().find('label').addClass('fieldTransformBack');
			}
			else{
				$(this).parent().find('label').addClass('fieldTransform');
				$(this).parent().find('label').removeClass('fieldTransformBack');
			}
		});
		// console.log(x);
	}

</script>