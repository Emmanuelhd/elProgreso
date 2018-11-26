<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cajera;

class HomeController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$cajeras = Cajera::all();
		return view('dashboard.index', ['cajeras'=>$cajeras]);
	}
}
