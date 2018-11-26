<?php

namespace App\Http\Controllers;

use App\ReporteCajera;
use App\Cajera;
use Illuminate\Http\Request;
use Funciones;
use Illuminate\Support\Facades\Validator;

class ReporteCajeraController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this -> middleware('auth');
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$model      = new ReporteCajera;
		$lastUpdate = Funciones::obtenLastUpdate($model);
		
		return view('dashboard.reporteCajeras.index', [
					'lastUpdate' => $lastUpdate
				]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$nombresCajeras = Cajera::all('id','nombre','apellidos');

		return view('dashboard.reporteCajeras.create', [
			'nombresCajeras' => $nombresCajeras,
		]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\ReporteCajera  $reporteCajera
	 * @return \Illuminate\Http\Response
	 */
	public function show(ReporteCajera $reporteCajera)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\ReporteCajera  $reporteCajera
	 * @return \Illuminate\Http\Response
	 */
	public function edit(ReporteCajera $reporteCajera)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\ReporteCajera  $reporteCajera
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, ReporteCajera $reporteCajera)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\ReporteCajera  $reporteCajera
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(ReporteCajera $reporteCajera)
	{
		//
	}

	public function capturaReporte(Request $request)
	{
		//Primero se validan los datos recibidos
		$validator = Validator::make($request->all(), [
			'idCajera' => 'required|numeric',
		]);

		if ($validator->fails()) 
		{
			//Si la validación falla, regreso el mensaje en el error
			$error = $validator->messages()->first();
			return response()->json(['status' => 'error', 'msg' => $error]);
		} else {
			//Si la validacion avanza, selecciono la cajer y la guardo en sesión
			try {
				$request -> session() -> put('cajeraSeleccionada', $request['idCajera']);
			} catch (Exception $e) {
				$response = array(
					'status' => 'success',
					'msg'    => 'Cajera Seleccionada',
				);
				return response()->json($response);
			}
			return response()->json(['status' => 'success', 'msg' => 'Cajera Seleccionada.']);
		}
	}
}
