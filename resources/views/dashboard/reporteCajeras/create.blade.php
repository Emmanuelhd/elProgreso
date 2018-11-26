@extends('dashboard.plantilla')

@section('content')
	<div class="container-fluid">
		<!-- Breadcrumbs-->
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="{{ route('home') }}">{{ __('app.dashboard') }}</a>
			</li>
			<li class="breadcrumb-item">
				<a href="{{ route('reportCashier.index') }}">{{ __('app.reportCashier') }}</a>
			</li>
			<li class="breadcrumb-item active">{{ __('app.newReport') }}</li>
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
			<div class="card card-register mx-auto mt-2" name="seleccionarCajera" id="seleccionarCajera">
				<div class="card-header" id="textoCajera">{{ __('app.selectCashier') }}</div>
				<div class="card-body">
					<div class="form-group">
						<div class="form-row">
							<div class="col-md-12">
								<div class="form-group">
									<select class="form-control" id="idCajera" name="idCajera">
										<option value=0 disabled selected>Seleccione una cajera</option>
										@foreach ($nombresCajeras as $nombreCajera)
											<option value="{{ $nombreCajera -> id }}">{{ $nombreCajera -> nombre }} {{ $nombreCajera -> apellidos }}</option>
										@endforeach
									</select>
								</div>
						</div>
					</div>
					<button class="btn btn-primary btn-block" type="submit" id="btnEnviar" name="btnEnviar" disabled> {{ __('app.select')}}</button>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
	<script>
		$(document).ready(function ()
		{
			$('#idCajera').change(function () {
				selectVal = $('#idCajera').val();
				if (selectVal == 0) {
					 $('#idCajera').prop("idCajera", true);
				}
				else {
					$('#btnEnviar').prop("disabled", false);
				}
			})
		});
	</script>
	<script>
		@if (!Auth::guest())
			$(document).ready(function(){
				var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
				$("#btnEnviar").click(function(){
					$.ajax({
						url: '/captureReport',
						type: 'POST',
						data: {
							_token: CSRF_TOKEN, 
							idCajera:$("#idCajera").val()
						},
						dataType: 'JSON',
						/* remind that 'data' is the response of the AjaxController */
						success: function (data) { 
							if (data['status'] == 'success')
							{
								//document.getElementById('btnEnviar').style.visibility = 'hidden';
								$("#seleccionarCajera").remove();
								$('#idCajera').prop("disabled", true);
								//span             = document.getElementById("textoCajera");
								//txt              = document.createTextNode("Cajera Seleccionada");
								//span.textContent = '';
								//span.appendChild(txt);
								swal({
									title: "{{ __('app.appName') }}",
									text: data.msg,
									icon: "success"
								});
							} else {
								swal({
									title: "{{ __('app.appName') }}",
									text: data['msg'],
									icon: "error"
								});
							}
							
						},
						error: function(data) {
							console.log(data)
						}
					}); 
				});
			});
		@endif
	</script>
@endsection