<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Aula
 * 
 * @property string $Id_A
 * @property string $Edificio_A
 * @property int $Capacidad_A
 * @property string $Descripcion_A
 * 
 * @property Collection|HorarioLibre[] $horario_libres
 * @property Collection|ReporteReserva[] $reporte_reservas
 *
 * @package App\Models
 */
class Aula extends Model
{
	protected $table = 'aula';
	protected $primaryKey = 'Id_A';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'Capacidad_A' => 'int'
	];

	protected $fillable = [
		'Edificio_A',
		'Capacidad_A',
		'Descripcion_A'
	];

	public function horario_libres()
	{
		return $this->hasMany(HorarioLibre::class, 'aula_Id_A');
	}

	public function reporte_reservas()
	{
		return $this->belongsToMany(ReporteReserva::class, 'reporte_reserva_aula', 'aula_Id_A', 'reporte_reserva_Id_RR')
					->withPivot('Fecha_Reserva_Ocupado_RRA', 'Horario_Ocupado_RRA');
	}
}
