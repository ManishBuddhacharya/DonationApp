@include('layouts.frontend.layout.header')
@include('layouts.frontend.layout.nav')
@include('layouts.frontend.pages.news.inc.header')

<section>

	<div class="block">

		<div class="container">

			<div class="row">
				@include('layouts.frontend.pages.news.inc.news')
				@include('layouts.frontend.pages.news.inc.sidenav')
			</div>

		</div>

	</div>

</section>

@include('layouts.frontend.layout.footer')