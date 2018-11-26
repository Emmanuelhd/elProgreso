<!doctype html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Laravel</title>

		<!-- Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

		<!-- Styles -->
		<style>
			html, body {
				background-color: #fff;
				color: #636b6f;
				font-family: 'Nunito', sans-serif;
				font-weight: 200;
				height: 100vh;
				margin: 0;
			}

			.full-height {
				height: 100vh;
			}

			.flex-center {
				align-items: center;
				display: flex;
				justify-content: center;
			}

			.position-ref {
				position: relative;
			}

			.top-right {
				position: absolute;
				right: 10px;
				top: 18px;
			}

			.content {
				text-align: center;
			}

			.title {
				font-size: 84px;
			}

			.links > a {
				color: #636b6f;
				padding: 0 25px;
				font-size: 12px;
				font-weight: 600;
				letter-spacing: .1rem;
				text-decoration: none;
				text-transform: uppercase;
			}

			.m-b-md {
				margin-bottom: 30px;
			}
		</style>
	</head>
	<body>        
		<div class="flex-center position-ref full-height">
			<div class="top-right links">
			@if (Route::has('login'))
				@auth
					<a href="{{ url('/home') }}">Home</a>
				@else
					<a href="{{ route('login') }}">{{ trans('app.login') }}</a>

					@if (Route::has('register'))
						<a href="{{ route('register') }}">{{ trans('app.register') }}</a>
					@endif
				@endauth
			@endif
				<small>
					<a href="{{ url('lang', ['es']) }}" style="text-decoration: none">
						<img src="{{ asset('png/mex.png') }}" height="15" width="15">
					</a>
				</small>	
				<small>
					<a href="{{ url('lang', ['en']) }}">
						<img src="{{ asset('png/usa.png') }}" height="15" width="15">
					</a>
				</small>			
			</div>
			<div class="content">
				<div class="title m-b-md">
					Carniceria El Progreso
				</div>
			</div>
		</div>
	</body>
</html>
