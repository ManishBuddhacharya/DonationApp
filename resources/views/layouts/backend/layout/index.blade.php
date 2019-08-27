@extends('layouts.backend.layout.master')
@section('body')
	<div class="be-wrapper">
		@include('layouts.backend.layout.nav')
		@include('layouts.backend.layout.left-side')
		@include('layouts.backend.layout.content')
		@include('layouts.backend.layout.right-side')
	</div>
@stop