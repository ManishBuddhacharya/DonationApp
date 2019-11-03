@if($event)
<section>
	<div class="block blackish">
	<div class="parallax" style="background:url(assets/images/parallax2.jpg);"></div>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="upcoming-event">
						<div class="row">
							<div class="col-md-6 column">
								<h3><i class="fa fa-bank"></i> Next Event on</h3>
								<span><i class="fa fa-calendar-o"></i> {{ \Carbon\Carbon::parse($event->created_at)->format('D/ m/ Y')}}</span>
								<span><i class="fa fa-clock-o"></i> {{ \Carbon\Carbon::parse($event->created_at)->format('h:i:s A')}}</span>
								<p>{{strip_tags($event->content)}}</p>
								<div class="remaining-time" style="height: 77px;">
									<div class="col-md-6 column">
										<h5>{{ucfirst($event->title)}}</h5>
									</div>
									<div class="col-md-6 timing column">
										<ul class="countdown">
											<li> <span class="days">00</span>
											<p class="days_ref">DAYS</p>
											</li>
											<li> <span class="hours">00</span>
											<p class="hours_ref">HOURS</p>
											</li>
											<li> <span class="minutes">00</span>
											<p class="minutes_ref">MINTS</p>
											</li>
											<li> <span class="seconds">00</span>
											<p class="seconds_ref">SECS</p>
											</li>
										</ul>
									</div>
								</div>
							</div>
							<div class="col-md-6 column">
								<img style="width: 600px; height: 280px;" src="{{"/images/".$event->file_name?:'/img/gallery/img11.jpg'}}">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endif