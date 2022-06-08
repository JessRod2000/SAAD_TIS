<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PeriodoAcademico
 * 
 * @property int $Id_PA
 * @property string $Semestre_PA
 * @property Carbon $Fecha_Inicio_PA
 * @property Carbon $Fecha_Fin_PA
 * 
 * @property Collection|SolicitudReserva[] $solicitud_reservas
 *
 * @package App\Models
 */
class PeriodoAcademico extends Model
{
	protected $table = 'periodo_academico';
	protected $primaryKey = 'Id_PA';
	public $timestamps = false;

	protected $dates = [
		'Fecha_Inicio_PA',
		'Fecha_Fin_PA'
	];

	protected $fillable = [
		'Semestre_PA',
		'Fecha_Inicio_PA',
		'Fecha_Fin_PA'
	];

	public function solicitud_reservas()
	{
		return $this->hasMany(SolicitudReserva::class, 'periodo_academico_Id_PA1');
	}
}
