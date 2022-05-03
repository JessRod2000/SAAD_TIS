<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ReporteAula
 * 
 * @property int $Id_RR_RA
 * @property string $Codi_A_RA
 * 
 * @property Aula $aula
 * @property ReporteReserva $reporte_reserva
 *
 * @package App\Models
 */
class ReporteAula extends Model
{
	protected $table = 'reporte_aula';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'Id_RR_RA' => 'int'
	];

	public function aula()
	{
		return $this->belongsTo(Aula::class, 'Codi_A_RA');
	}

	public function reporte_reserva()
	{
		return $this->belongsTo(ReporteReserva::class, 'Id_RR_RA');
	}
}
