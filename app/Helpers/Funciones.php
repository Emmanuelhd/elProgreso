<?php
namespace App\Helpers;

use Lang;
use Carbon\Carbon;
/*
 * Obtiene la ultima modificacion del modelo enviado
 */
class Funciones
{
	public static function obtenLastUpdate($model)
	{
		//Obtengo el ultimo registro modificado de la tabla
		$lastUpdate = $model::select('updated_at')
								->where('id','>',0)
								->orderBy('updated_at', 'desc')
								->first();
		//Si no existe ninguna cajera regresa Never
		if (!$lastUpdate)
		{
			return Lang::get('app.never');
		}

		//Solo me quedo con el valor del campo
		$lastUpdate = $lastUpdate -> updated_at;

		//Lo formateo para poder regresarlo
		$lastUpdate = Carbon::parse($lastUpdate)->format('d-M-Y');

		return $lastUpdate;
	}
	
}