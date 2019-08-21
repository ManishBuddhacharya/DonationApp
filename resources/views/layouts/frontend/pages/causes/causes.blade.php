@include('layouts.frontend.layout.header')
@include('layouts.frontend.layout.nav')
@include('layouts.frontend.pages.causes.inc.header')

<section>

	<div class="block">

		<div class="container">

			<div class="row">
				@include('layouts.frontend.pages.causes.inc.causes')
				@include('layouts.frontend.pages.causes.inc.sidenav')
			</div>

		</div>

	</div>

</section>

@include('layouts.frontend.layout.footer')