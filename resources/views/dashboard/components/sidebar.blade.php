<!-- Sidebar -->
<ul class="sidebar navbar-nav">
	<li class="nav-item active">
		<a class="nav-link" href="{{ route('home') }}">
			<i class="fas fa-fw fa-tachometer-alt"></i>
			<span>{{ __('app.dashboard') }}</span>
		</a>
	</li>
	{{--  
	<li class="nav-item dropdown">
		<a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			<i class="fas fa-fw fa-folder"></i>
			<span>Pages</span>
		</a>
		<div class="dropdown-menu" aria-labelledby="pagesDropdown">
			<h6 class="dropdown-header">Login Screens:</h6>
			<a class="dropdown-item" href="login.html">Login</a>
			<a class="dropdown-item" href="register.html">Register</a>
			<a class="dropdown-item" href="forgot-password.html">Forgot Password</a>
			<div class="dropdown-divider"></div>
			<h6 class="dropdown-header">Other Pages:</h6>
			<a class="dropdown-item" href="404.html">404 Page</a>
			<a class="dropdown-item" href="blank.html">Blank Page</a>
		</div>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="charts.html">
			<i class="fas fa-fw fa-chart-area"></i>
			<span>Charts</span></a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="tables.html">
			<i class="fas fa-fw fa-table"></i>
			<span>Tables</span></a>
	</li>
	--}}
		@if (Auth::check() &&  Auth::user()->role == 'admin')
		<!--Menu para agregar o eliminar cajeras -->
			<li class="nav-item dropdown">
				<a 
					class         = "nav-link dropdown-toggle" 
					href          = "#" 
					id            = "pagesDropdown" 
					role          = "button" 
					data-toggle   = "dropdown" 
					aria-haspopup = "true" 
					aria-expanded = "false"
				>
					<i class="fas fa-fw fa-user"></i>
					<span>{{ __('app.cashiers') }}</span>
				</a>
				<div class="dropdown-menu" aria-labelledby="pagesDropdown">
					<h6 class="dropdown-header">{{ __('app.options') }}</h6>
					<a class="dropdown-item" href="{{ route('cashiers.index') }}">{{ __('app.seeAllCashiers') }}</a>
					<a class="dropdown-item" href="{{ route('cashiers.create') }}">{{ __('app.addCashier') }}</a>
				</div>
			</li>
			<li class="nav-item dropdown">
				<a 
					class         = "nav-link dropdown-toggle" 
					href          = "#" 
					id            = "pagesDropdown" 
					role          = "button" 
					data-toggle   = "dropdown" 
					aria-haspopup = "true" 
					aria-expanded = "false"
				>
					<i class="fas fa-fw fa-file-invoice-dollar"></i>
					<span>{{ __('app.reportCashier') }}</span>
				</a>
				<div class="dropdown-menu" aria-labelledby="pagesDropdown">
					<h6 class="dropdown-header">{{ __('app.shifts') }}</h6>
					<a class="dropdown-item" href="{{ route('reportCashier.index') }}">{{ __('app.seeList') }}</a>
					<a class="dropdown-item" href="{{ route('reportCashier.create') }}">{{ __('app.newReport') }}</a>
				</div>
			</li>
		@endif
</ul>