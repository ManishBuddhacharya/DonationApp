@include('layouts.frontend.layout.header')
@include('layouts.frontend.layout.nav')
<div id="section-wrapper">
	<div class="page-top">

		<div class="parallax" style="background:url(/assets/images/parallax1.jpg);"></div>	

		<div class="container"> 

			<h1>{{$cause->title}}</h1>

			<ul>

				<li><a href="index.html" title="">Home</a></li>

				<li><a href="sermons.html" title="">Causes</a></li>

			</ul>

		</div>

	</div>

	<section>

		<div class="block">

			<div class="container">

				<div class="row">
					<style>
						#donate_button {
						background: #2d695c;
					    display: inline-block;
					    font-size: 13px;
					    padding: 8px 25px;
					    text-transform: uppercase;
					    -webkit-border-radius: 2px;
					    -moz-border-radius: 2px;
					    -ms-border-radius: 2px;
					    -o-border-radius: 2px;
					    border-radius: 2px;
					    -webkit-transition: all 0.4s linear;
					    -moz-transition: all 0.4s linear;
					    -ms-transition: all 0.4s linear;
					    -o-transition: all 0.4s linear;
					    transition: all 0.4s linear;
					    line-height: 0;
					    color: #fff;
					    margin-top: 0px;
					    height: 30px;

					}
					#donate_button:hover {
					    padding: 5px 30px;
					}
					</style>
					<div class="container column">
						<div class="container">
						    <div class='row'>
						        <div class='col-md-2'></div>
						        <div class='col-md-8'>
									<div class="single-page">

										<img src="{{"/images/".$cause->file_name?:'/img/gallery/img11.jpg'}}" alt="">

										<h2>{{$cause->title}}</h2>

										<div class="meta">

											<ul>

												<li><i class="fa fa-reply"></i> Posted In <a href="#" title="">Cause</a></li>

												<li><i class="fa fa-calendar-o"></i> {{ \Carbon\Carbon::parse($cause->created_at)->format('D/ F/ Y')}}</li>

												<li><i class="fa fa-user"></i> <a href="#" title="">{{$cause->user()->name}}</a></li>

											</ul>

											<img src="/assets/images/resource/author.jpg" alt="">

										</div><!-- POST META -->

										<ul class="sermon-media lightbox width-100">
											<span>

												<a class="blog-date" href="#" title="" style="font-size: 20px; margin-right: 5%;"><i class="fa fa-bank"></i> Goal : <span style="color: #000">$ {{$cause->goal}}</span></a>
												<a class="blog-date" href="#" title="" style="font-size: 20px; margin-right: 5%;"><i class="fa fa-money"></i>Raised : $<span style="color: #000">{{$cause->transactions->sum('amount')?:0}}</span></a>
												<a class="blog-date" href="#" title="" style="font-size: 20px; margin-right: 5%;"><i class="fa fa-money"></i>Status : <span style="color: #000">{{ceil($cause->transactions->sum('amount') / $cause->goal * 100)}}%</span></a>

												{{-- <button class="btn btn-sm pull-right" id="donate_button">Donate</button> --}}

											</span>
										</ul>

									</div><!-- SERMON SINGLE -->
								</div>
						        <div class='col-md-2'></div>
						    </div>
						</div>

						<div class="container">
						    <div class='row'>
						        <div class='col-md-2'></div>
						        <div class='col-md-8'>
						            <script src='https://js.stripe.com/v2/' type='text/javascript'></script>
						            <form accept-charset="UTF-8" action="/cause/donate" class="require-validation"
						                data-cc-on-file="false"
						                data-stripe-publishable-key="pk_test_HWXJvemu3UMjLToQMuQXdVHf00hbtPgsPF"
						                id="payment-form" method="post">
						                {{ csrf_field() }}
						                <div class='form-row'>
						                    <div class='col-xs-12 form-group required'>
						                        <label class='control-label'>Name on Card</label> <input
						                            class='form-control' size='4' type='text'>
						                    </div>
						                </div>
						                <div class='form-row'>
						                    <div class='col-xs-12 form-group card required'>
						                        <label class='control-label'>Card Number</label> <input
						                            autocomplete='off' class='form-control card-number' size='20'
						                            type='text'>
						                    </div>
						                </div>
						                <div class='form-row'>
						                    <div class='col-xs-4 form-group cvc required'>
						                        <label class='control-label'>CVC</label> <input
						                            autocomplete='off' class='form-control card-cvc'
						                            placeholder='ex. 311' size='4' type='text'>
						                    </div>
						                    <div class='col-xs-4 form-group expiration required'>
						                        <label class='control-label'>Expiration</label> <input
						                            class='form-control card-expiry-month' placeholder='MM' size='2'
						                            type='text'>
						                    </div>
						                    <div class='col-xs-4 form-group expiration required'>
						                        <label class='control-label'> </label> <input
						                            class='form-control card-expiry-year' placeholder='YYYY'
						                            size='4' type='text'>
						                    </div>
						                </div>
						                <div class='form-row'>
						                    <div class='col-xs-12 form-group card required'>
						                        <label class='control-label'>Donation Amount</label> 
						                        <input
						                            autocomplete='off' class='form-control card-number' name="amount"
						                            type='number'>
						                            <input type="hidden" name="cause_id" value="{{$cause->id}}">
						                    </div>
						                </div>
						                <div class='form-row'>
						                    <div class='col-md-12 form-group'>
						                        <button class='form-control btn btn-primary submit-button'
						                            type='sub
						                            mit' style="margin-top: 10px; color: #fff; background: #428bca;">Donate »</button>
						                    </div>
						                </div>
						                <div class='form-row'>
						                    <div class='col-md-12 error form-group hide'>
						                        <div class='alert-danger alert'>Please correct the errors and try
						                            again.</div>
						                    </div>
						                </div>
						            </form>
						            @if ((Session::has('success-message')))
						            <script type="text/javascript">
						            	$(document).ready(function(){
							            	Swal.fire(
											  '{{Session::get('success-message') }}',
											  'thank you for Danating :)',
											  'success'
											);
						            	});
						            </script>
						            <div class="alert alert-success col-md-12">{{
						                Session::get('success-message') }}</div>
						            @endif @if ((Session::has('fail-message')))
						            <div class="alert alert-danger col-md-12">{{
						                Session::get('fail-message') }}</div>
						            @endif
						        </div>
						        <div class='col-md-2'></div>
						    </div>
						</div>

					</div>

					<script>
						$('#donate_button').off('click').on('click', function(e){
						$(function() {
					          $('form.require-validation').bind('submit', function(e) {
					            var $form         = $(e.target).closest('form'),
					                inputSelector = ['input[type=email]', 'input[type=password]',
					                                 'input[type=text]', 'input[type=file]',
					                                 'textarea'].join(', '),
					                $inputs       = $form.find('.required').find(inputSelector),
					                $errorMessage = $form.find('div.error'),
					                valid         = true;
					            $errorMessage.addClass('hide');
					            $('.has-error').removeClass('has-error');
					            $inputs.each(function(i, el) {
					              var $input = $(el);
					              if ($input.val() === '') {
					                $input.parent().addClass('has-error');
					                $errorMessage.removeClass('hide');
					                e.preventDefault(); // cancel on first error
					              }
					            });
					          });
					        });


					        $(function() {
					          var $form = $("#payment-form");
					          $form.on('submit', function(e) {
					            if (!$form.data('cc-on-file')) {
					              e.preventDefault();
					              Stripe.setPublishableKey($form.data('stripe-publishable-key'));
					              Stripe.createToken({
					                number: $('.card-number').val(),
					                cvc: $('.card-cvc').val(),
					                exp_month: $('.card-expiry-month').val(),
					                exp_year: $('.card-expiry-year').val()
					              }, stripeResponseHandler);
					            }
					          });


					          function stripeResponseHandler(status, response) {
					            console.log(response);
					            if (response.error) {
					              $('.error')
					                .removeClass('hide')
					                .find('.alert')
					                .text(response.error.message);
					            } else {
					              // token contains id, last4, and card type
					              var token = response['id'];
					              // insert the token into the form so it gets submitted to the server
					              $form.find('input[type=text]').empty();
					              $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
					              $form.get(0).submit();
					            }
					          }
					        })
					</script>
				</div>

			</div>

		</div>

	</section>
</div>
@include('layouts.frontend.layout.footer')