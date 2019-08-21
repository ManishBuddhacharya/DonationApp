@include('layouts.frontend.layout.header')
@include('layouts.frontend.layout.nav')
@include('layouts.frontend.pages.stories.inc.header')

<section>

	<div class="block">

		<div class="container">

			<div class="row">
				@include('layouts.frontend.pages.stories.inc.stories')
				@include('layouts.frontend.pages.stories.inc.sidenav')
			</div>

		</div>

	</div>

</section>

@include('layouts.frontend.layout.footer')