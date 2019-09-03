@extends('layouts.backend.layout.master')
@section('body')
	<div class="be-wrapper">
		@include('layouts.backend.layout.nav')
		@include('layouts.backend.layout.left-side')
		<div class="section-wrapper">
			@include('layouts.backend.layout.content')
		</div>
		@include('layouts.backend.layout.right-side')
	</div>
@stop