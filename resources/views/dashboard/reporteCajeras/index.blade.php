@extends('dashboard.plantilla')

@section('content')
	<div class="container-fluid">
		<!-- Breadcrumbs-->
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="{{ route('home') }}">{{ __('app.dashboard') }}</a>
			</li>
			<li class="breadcrumb-item active">{{ __('app.reportCashier') }}</li>
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
	<div class="row">
		<div class="col-lg-12 col-md-12 text-right container-fluid">
			<a href="{{ route('reportCashier.create') }}" style="text-decoration: none;">
				<button class="btn btn-success">
					<i class="fas fa-fw fa-plus"></i>
					Nuevo Reporte
				</button>
			</a>
			&nbsp;&nbsp;
		</div>
	</div>
	<div id="content-wrapper">
		<div class="container-fluid">
			<div class="card mb-2">
				<div class="card-header">
					<div class="row">
						<div class="col-lg-6">
							<i class="fas fa-th-list"></i>
							{{ __('app.lastReports') }}
						</div>									
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive ">
						<table class="table table-bordered" id="dataTable" width="75%" cellspacing="0" align="center">
							<thead>
								<tr style="text-transform: capitalize;">
									{{--  
									@foreach ($campos as $campo)
										<th>{{ $campo }}</th>
									@endforeach
									@if (!Auth::guest() && Auth::user()->role == 'admin')
										<th>{{ __('app.options') }}</th>
									@endif--}}
								</tr>
							</thead>

							<tbody>
								{{-- @foreach ($cajeras as $cajera)
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
								@endforeach	 --}}	
							</tbody>
						</table>
					</div>
				</div>
				<div class="card-footer small text-muted">Updated {{ $lastUpdate }}</div>
			</div>
		</div>
	</div>
@endsection