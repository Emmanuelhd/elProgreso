@extends('dashboard.plantilla')

@section('content')
	<div class="container-fluid">
		<!-- Breadcrumbs-->
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="{{ route('home') }}">{{ __('app.dashboard') }}</a>
			</li>
			<li class="breadcrumb-item">
				<a href="{{ route('cashiers.index') }}">{{ __('app.cashiers') }}</a>
			</li>
			<li class="breadcrumb-item active">{{ __('app.edit') }} {{ $cajera->nombre }}</li>
		</ol>
	</div>
	<div class="container-fluid">
		<div class="card card-register mx-auto mt-2">
			<div class="card-header">{{ __('app.editCashier') }}</div>
			<div class="card-body">
				<form method="POST" action="{{ route('cashiers.update', $cajera->id) }}">
					@method('PUT')
					@csrf
					<div class="form-group">
						<div class="form-row">
							<div class="col-md-12">
								<div class="form-label-group">
									<input 
										type        = "text"
										id          = "nombre"
										name        = "nombre"
										class       = "form-control"
										placeholder = "{{ __('app.name') }}"
										required
										autofocus   = "autofocus"
										value       = "{{ $cajera->nombre }}"
									>
									<label for="nombre">{{ __('app.name') }}</label>
								</div>
							</div>
						</div>
						<br>
						<div class="form-row">
							<div class="col-md-12">
								<div class="form-label-group">
									<input 
										type        = "text" 
										id          = "apellidos"
										name        = "apellidos"
										class       = "form-control" 
										placeholder = "{{ __('app.lastName') }}" 
										required    = "required"
										value       = "{{ $cajera->apellidos }}"
									>
									<label for="apellidos">{{ __('app.lastName') }}</label>
								</div>
							</div>
						</div>
					</div>
					<button class="btn btn-primary btn-block" type="submit">{{ __('app.update') }}</button>
				</form>
			</div>
		</div>
	</div>
@endsection