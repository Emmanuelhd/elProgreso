<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

	<head>
		@include('dashboard.components.header')
		<meta name="csrf-token" content="{{ csrf_token() }}">
	</head>

	<body id="page-top">
		@include('dashboard.components.navbar')
		<div id="wrapper">
			@include('dashboard.components.sidebar')
			<div id="content-wrapper">
				<main class="py-4">
					@yield('content')
				</main>
			</div>
		</div>
		@include('dashboard.components.footer')
		@include('dashboard.components.topButton')
		@include('dashboard.components.logoutModal')
		@include('dashboard.components.javascript')
		@yield('scripts')
	</body>
</html>