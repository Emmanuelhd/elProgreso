<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReporteCajera extends Model
{
	 /**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'reporte_cajeras';

	 /**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'id_cajera',
		'salesToday',
		'foodStamps',
		'invoices',
		'lotto',
		'wic',
		'atm',
		'meatDepartment',
		'cheks',
		'return',
		'payroll',
		'overShort',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'id', 'created_at', 'updated_at'
	];


	public function cajera()
	{
		return $this -> belongsTo('App\Cajera');
	}
}
