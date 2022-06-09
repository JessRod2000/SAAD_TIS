<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ReporteReserva
 * 
 * @property int $Id_RR
 * @property string $Estado_RR
 * @property string $Observacion_RR
 * @property Carbon $Fecha_Reporte_RR
 * @property int $solicitud_reserva_Id_SR
 * @property int $usuarios_Codigo_SIS_U
 * 
 * @property SolicitudReserva $solicitud_reserva
 * @property User $user
 * @property Collection|Notificacion[] $notificacions
 * @property Collection|Aula[] $aulas
 *
 * @package App\Models
 */
class ReporteReserva extends Model
{
	protected $table = 'reporte_reserva';
	protected $primaryKey = 'Id_RR';
	public $timestamps = false;

	protected $casts = [
		'solicitud_reserva_Id_SR' => 'int',
		'usuarios_Codigo_SIS_U' => 'int'
	];

	protected $dates = [
		'Fecha_Reporte_RR'
	];

	protected $fillable = [
		'Estado_RR',
		'Observacion_RR',
		'Fecha_Reporte_RR',
		'solicitud_reserva_Id_SR',
		'usuarios_Codigo_SIS_U'
	];

	public function solicitud_reserva()
	{
		return $this->belongsTo(SolicitudReserva::class, 'solicitud_reserva_Id_SR');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'usuarios_Codigo_SIS_U');
	}

	public function notificacions()
	{
		return $this->hasMany(Notificacion::class, 'reporte_reserva_Id_RR');
	}

	public function aulas()
	{
		return $this->belongsToMany(Aula::class, 'reporte_reserva_aula', 'reporte_reserva_Id_RR', 'aula_Id_A')
					->withPivot('Fecha_Reserva_Ocupado_RRA', 'Horario_Ocupado_Inicio_RRA', 'Periodos_RRA', 'Estado_RRA');
	}
}
