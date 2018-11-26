<?php

namespace App\Http\Controllers;

use App\Cajera;
use Illuminate\Http\Request;
use Lang;
use Auth;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Session;
use Funciones;

class CajeraController extends Controller
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
		//Obtengo todas las cajeras
		$cajeras    = Cajera::all();

		//Obtengo los capos que se pueden llenar para mostrarlos en la vista
		$cajera     = new Cajera;
		$campos     = $cajera -> getFillable();

		//Obtengo la fecha del ultimo update a traves de la funcion obtenLastUpdate
		$lastUpdate = Funciones::obtenLastUpdate($cajera);

		return view('dashboard.cajeras.index', [
			'cajeras'    => $cajeras,
			'campos'     => $campos, 
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
		if (Auth::user()->role == "admin")
		{
			return view('dashboard.cajeras.add');
		} else {
			return redirect('cashiers')->with('error', Lang::get('app.noLevel'));;
		}
		
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		//Primero se validan los datos recibidos
		$data   = $this->validate($request, [
			'nombre'    =>'required',
			'apellidos' => 'required'
		]);
		
		//Creao una nueva instancia de Cjera y le asigno los datos recibidos
		$cajera = new Cajera();
		$cajera -> nombre    = $data['nombre'];
		$cajera -> apellidos = $data['apellidos'];
		$cajera -> save();

		//Después de haber guardado los datos se redirige 
		//al usuario a la vista de cajeras
		Session::flash('message', Lang::get('app.createCashierSuccess'));
		return Redirect::to(route('cashiers.index'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Cajera  $cajera
	 * @return \Illuminate\Http\Response
	 */
	public function show(Cajera $cajera)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @param  \App\Cajera  $cajera
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		if (Auth::user()->role == "admin")
		{
			$cajera = Cajera::find($id);

			return view('dashboard.cajeras.edit', compact('cajera'));
		} else {
			return redirect('cashiers')->with('error', Lang::get('app.noLevel'));;
		}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int $id
	 * @param  \App\Cajera $cajera
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Cajera $cajera, $id)
	{
		//Valido que el usuario complete todos los capos
		$data   = $this->validate($request, [
			'nombre'    => 'required',
			'apellidos' => 'required'
		]);

		//Busco el id y reemplazo los datos existentes por los nuevos
		$cajera = Cajera::find($id);
		$cajera -> nombre    = $request -> get('nombre');
		$cajera -> apellidos = $request -> get('apellidos');
		$cajera -> save();

		//Redirecciono al index con un mensaje
		Session::flash('message', Lang::get('app.editSuccess'));
		return Redirect::to(route('cashiers.index'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Cajera  $cajera
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Cajera $cajera)
	{
		//
	}

	public function delete($id)
	{
		//Verifica que el usuario sea administrador
		if (Auth::user()->role == "admin")
		{
			$cajera = Cajera::find($id);
			
			//Busca la cajera y maneja el erro en caso de que no exista
			if (!$cajera)
			{
				return response() -> json("No se encontró la cajera" + $id);
			} else {
				$cajera -> delete();
				return response() -> json("Cajera eliminada correctamente");
			}
		} else {
			//Regresa una respuesta indicando que no se tiene privilegios
			return response() -> json(Lang::get('app.noLevel'),401);
		}
		
	}
}
