@extends('dashboard.plantilla')

@section('content')
	<div class="container-fluid">
		<div class="card card-register mx-auto mt-2">
			<div class="card-header">{{ __('app.addNewCashier') }}</div>
			<div class="card-body">
				<form method="POST" action="{{ route('cashiers.store') }}">
					@csrf
					<div class="form-group">
						<div class="form-row">
							<div class="col-md-6">
								<div class="form-label-group">
									<input 
										type        = "text"
										id          = "nombre"
										name        = "nombre"
										class       = "form-control"
										placeholder = "{{ __('app.name') }}"
										required
										autofocus   = "autofocus"
									>
									<label for="nombre">{{ __('app.name') }}</label>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-label-group">
									<input 
										type        = "text" 
										id          = "apellidos"
										name        = "apellidos"
										class       = "form-control" 
										placeholder = "{{ __('app.lastName') }}" 
										required    ="required"
									>
									<label for="apellidos">{{ __('app.lastName') }}</label>
								</div>
							</div>
						</div>
					</div>
					<button class="btn btn-primary btn-block" type="submit">{{ __('app.addCashier') }}</button>
				</form>
			</div>
		</div>
	</div>
@endsection