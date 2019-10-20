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
<div class="col-md-8 column">

	<div class="single-page">

		<img src="{{"/images/".$cause->file_name?:'/img/gallery/img11.jpg'}}" alt="">

		<h2>{{$cause->title}}</h2>

		<div class="meta">

			<ul>

				<li><i class="fa fa-reply"></i> Posted In <a href="#" title="">Cause</a></li>

				<li><i class="fa fa-calendar-o"></i> {{ \Carbon\Carbon::parse($cause->created_at)->format('D/ F/ Y')}}</li>

				<li><i class="fa fa-user"></i> <a href="#" title="">{{$cause->user()->name}}</a></li>

			</ul>

			<img src="{{"/images/".$cause->user()->profile_img?:'/img/gallery/img11.jpg'}}" alt="">

		</div><!-- POST META -->

		<ul class="sermon-media lightbox width-100">
			<span>

				<a class="blog-date" href="#" title="" style="font-size: 20px; margin-right: 5%;"><i class="fa fa-bank"></i> Goal : <span style="color: #000">$ {{$cause->goal}}</span></a>
				<a class="blog-date" href="#" title="" style="font-size: 20px; margin-right: 5%;"><i class="fa fa-money"></i>Raised : $<span style="color: #000">{{$cause->transactions->sum('amount')?:0}}</span></a>
				<a class="blog-date" href="#" title="" style="font-size: 20px; margin-right: 5%;"><i class="fa fa-money"></i>Status : <span style="color: #000">{{ceil($cause->transactions->sum('amount') / $cause->goal * 100)}}%</span></a>

				<button class="btn btn-sm pull-right" id="donate_button">Donate</button>

			</span>
		</ul>

	</div><!-- SERMON SINGLE -->

	

	{!!$cause->content!!}



	<div class="share-this">

		<h5><i class="fa fa-share"></i> SHARE THIS Cause</h5>

		<ul class="social-media">

			<li><a href="#" title=""><i class="fa fa-linkedin"></i></a></li>

			<li><a href="#" title=""><i class="fa fa-google-plus"></i></a></li>

			<li><a href="#" title=""><i class="fa fa-twitter"></i></a></li>

			<li><a href="#" title=""><i class="fa fa-facebook"></i></a></li>

		</ul>				

	</div><!-- SHARE THIS -->

	@include('layouts.frontend.pages.causes.inc.comment')
</div>

<script>
	$('#donate_button').off('click').on('click', function(e){
		let url = '/cause/donate/{{$cause->id}}';
		window.open(url);
	})
</script>