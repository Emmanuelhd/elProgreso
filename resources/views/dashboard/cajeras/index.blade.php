@extends('dashboard.plantilla')

@section('content')
	<div class="container-fluid">
	<!-- Breadcrumbs-->
	<ol class="breadcrumb">
		<li class="breadcrumb-item">
			<a href="{{ route('home') }}">{{ __('app.dashboard') }}</a>
		</li>
		<li class="breadcrumb-item active"><a href="{{ route('cashiers.index') }}">{{ __('app.cashiers') }}</a></li>
	</ol>
	</div>
	<div class="row">
		<div class="col-lg-4"></div>
		<div class="col-lg-4">
			@if(Session::has('message'))
				@include('extras.successAlert')
			@endif
			@if(Session::has('error'))
				@include('extras.errorAlert')
			@endif

		</div>
	</div>
	<div id="content-wrapper">
		<div class="container-fluid">
			<div class="card mb-2">
				<div class="card-header">
					<div class="row">
						<div class="col-lg-6">
							<i class="fas fa-th-list"></i>
							{{ __('app.seeAllCashiers') }}
						</div>
						<div class="col-lg-6" align="right">
							@if (!Auth::guest() && Auth::user()->role == 'admin')
								<a href="{{ route('cashiers.create') }}">
									<button class="btn btn-success btn-sm">
										<i class="fas fa-plus"></i>
										&nbsp;Crear Cajera
									</button>
								</a>
							@endif
						</div>									
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive ">
						<table class="table table-bordered" id="dataTable" width="75%" cellspacing="0" align="center">
							<thead>
								<tr style="text-transform: capitalize;">
									@foreach ($campos as $campo)
										<th>{{ $campo }}</th>
									@endforeach
									@if (!Auth::guest() && Auth::user()->role == 'admin')
										<th>{{ __('app.options') }}</th>
									@endif
								</tr>
							</thead>

							<tbody>
								@foreach ($cajeras as $cajera)
									<tr>
										<td>{{ $cajera -> nombre }}</td>
										<td>{{ $cajera -> apellidos }}</td>
										@if (!Auth::guest() && Auth::user()->role == 'admin')
											<td align="center">
												<a href="{{ route('cashiers.edit', $cajera->id)}}" style="text-decoration:none" >
													<button class="btn btn-primary btn-sm">
														<i class="fa fa-edit"></i>
														{{ __('app.edit') }}
													</button>
												</a>												
												<button 
													class="btn btn-danger btn-sm" 
													id          = "{{ $cajera -> id }}"
													name        = "eliminar{{ $cajera -> id }}"
													onclick     = "showModal(this)"
													data-target = "#modalEliminar"
													data-name   = "{{ $cajera -> nombre }}"
													data-id     = "{{ $cajera -> id }}"
												>
													<i class="fa fa-trash"></i>
													{{ __('app.delete') }}
												</button>														
											</td>
										@endif
									</tr>											
								@endforeach		
							</tbody>
						</table>
					</div>
				</div>
				<div class="card-footer small text-muted">Updated {{ $lastUpdate }}</div>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
	@if (!Auth::guest() && Auth::user()->role == 'admin')
		{{-- Script para mostrar el Modal para eliminar una cajera --}}
		<script type="text/javascript">
			function showModal(e) {
				{{-- Obtengo el nombre y el id desde el boton presionado --}}
				name = e.getAttribute('data-name');
				id   = e.getAttribute('data-id');

				{{-- Muestro el Modal con los datos recibidos --}}
				$('#modalEliminar').modal('show');
				swal({
					title: "{{ __('app.appName') }}",
					text: "{{ __('app.confirmDelete') }}"+ name +"?",
					icon: "warning",
					buttons: ["{{ __('app.cancel') }}", "{{ __('app.delete') }}"],
					dangerMode: true,
				})
				.then((value) => {
					{{-- Si el usuario confirma que desea eliminar, se procede --}}
					if (value == true){
						$.ajax({
							{{-- Mando todos lo datos, el token es necesrio por laravel
								 Se manda el id a una funcion que yo mismo cree
								 en el controller de Cajera 
							--}}
							headers: {
								'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
							},
							type: "POST",
							url: "deleteCashier/" + id,
							data: {id:id},

							{{-- Si es correcto se muestra el modal y se redirige --}}
							success: function (data) {
								swal({
									title: "{{ __('app.appName') }}",
									text: data,
									icon: "success",
								})
								.then((value) => {
									if ((value == true) || (value == null)){
										location.reload();
									}	
								});
							},
							{{-- Si hay un error muestra el mensaje --}}
							error: function (data) {
								swal({
									title: "Error",
									text: data.responseJSON,
									icon: "error"
								});
							}    
						});
					}	
				});
			}
		</script>
	@endif


