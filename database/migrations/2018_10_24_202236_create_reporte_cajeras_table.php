<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReporteCajerasTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reporte_cajeras', function (Blueprint $table) {
			$table -> increments('id');
			
			$table -> unsignedInteger('id_cajera');
			$table -> double('salesToday', 8, 4) -> default(0);
			$table -> double('foodStamps', 8, 4) -> default(0);
			$table -> double('invoices', 8, 4) -> default(0);
			$table -> double('lotto', 8, 4) -> default(0);
			$table -> double('wic', 8, 4) -> default(0);
			$table -> double('atm', 8, 4) -> default(0);
			$table -> double('meatDepartment', 8, 4) -> default(0);
			$table -> double('cheks', 8, 4) -> default(0);
			$table -> double('return', 8, 4) -> default(0);
			$table -> double('payroll', 8, 4) -> default(0);
			$table -> double('overShort', 8, 4) -> default(0);
			$table -> foreign('id_cajera')->references('id') -> on('cajeras') -> onDelete('cascade');;

			$table -> timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('reporte_cajeras');
	}
}
