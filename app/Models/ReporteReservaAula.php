<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ReporteReservaAula
 * 
 * @property int $reporte_reserva_Id_RR
 * @property string $aula_Id_A
 * @property Carbon $Fecha_Reserva_Ocupado_RRA
 * @property Carbon $Horario_Ocupado_RRA
 * 
 * @property Aula $aula
 * @property ReporteReserva $reporte_reserva
 *
 * @package App\Models
 */
class ReporteReservaAula extends Model
{
	protected $table = 'reporte_reserva_aula';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'reporte_reserva_Id_RR' => 'int'
	];

	protected $dates = [
		'Fecha_Reserva_Ocupado_RRA',
		'Horario_Ocupado_RRA'
	];

	protected $fillable = [
		'Fecha_Reserva_Ocupado_RRA',
		'Horario_Ocupado_RRA'
	];

	public function aula()
	{
		return $this->belongsTo(Aula::class, 'aula_Id_A');
	}

	public function reporte_reserva()
	{
		return $this->belongsTo(ReporteReserva::class, 'reporte_reserva_Id_RR');
	}
}
