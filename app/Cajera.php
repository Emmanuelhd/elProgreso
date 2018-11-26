<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cajera extends Model
{
	 /**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'cajeras';

	 /**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'nombre', 'apellidos',
	];

	public function reporteCajera()
	{
		return $this->hasMany('App\ReporteCajera');
	}
}
