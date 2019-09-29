<style>
	#ticket_button {
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
    height: 30px;

}
#ticket_button:hover {
    padding: 5px 30px;
}
</style>

<div class="col-md-8 column">

	<div class="single-page">

		<img src="{{"/images/".$event->file_name?:'/img/gallery/img11.jpg'}}" alt="">

		<h2>
			{{ucfirst($event->title)}}
		</h2>
		@if(auth()->user()->id)
		<button class="btn btn-sm pull-right mt-10 mr-10" id="ticket_button">Attend Event</button>
		@endif

		<div class="meta">

			<ul style="display: flex; justify-content: space-around;">

				<li><i class="fa fa-map-marker"></i> {{ucfirst($event->address)}}</li>

				<li><i class="fa fa-calendar-o"></i> 
					{{ \Carbon\Carbon::parse($event->created_at)->format('D/ m/ Y H:i A')}}
				</li>

				<li><i class="fa fa-user"></i> <a href="#" title="">PAUL LAZARIUS</a></li>

			</ul>

			<assets/img src="images/resource/author.jpg" alt="">

		</div><!-- POST META -->

	</div><!-- SERMON SINGLE -->

	

	{!!$event->content!!}



	<div class="share-this">

		<h5><i class="fa fa-share"></i> SHARE THIS SERMON</h5>

		<ul class="social-media">

			<li><a href="#" title=""><i class="fa fa-linkedin"></i></a></li>

			<li><a href="#" title=""><i class="fa fa-google-plus"></i></a></li>

			<li><a href="#" title=""><i class="fa fa-twitter"></i></a></li>

			<li><a href="#" title=""><i class="fa fa-facebook"></i></a></li>

		</ul>				

	</div><!-- SHARE THIS -->

	@include('layouts.frontend.pages.events.inc.comment')

</div>

<script>
	$('#ticket_button').off('click').on('click', function(e){
	    e.preventDefault();
	    let url = "/frontend/event/attend/{{$event->id}}/{{auth()->user()->id}}";

	    Swal.fire({
	        title: 'Are you sure you want to attend this event?',
	        text: 'You will get a mail of confirmation after clicking on yes.',
	        type: 'info',
	        showCancelButton: true,
	        confirmButtonText: 'Yes',
	        cancelButtonText: 'cancel'
	    }).then((result) => {
	        if (result.value) {
	            $.ajax({
	                method:'get',
	                url:url,
	                success:function(data)
	                {
	                	Swal.fire(
						  'Attending event confirmed',
						  'A mail has been sent to your email, please use that to enter the in event place',
						  'success'
						)
	                },
	                error:function(e)
	                {
	                    alert('dsadad');
	                }
	            });

	        }
	    })
	});

	function eventDeatail(){
	    let url = '/frontend/event/detail/{{$event->id}}';
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
	}
</script>