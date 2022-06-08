<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Notificacion
 * 
 * @property int $Id_N
 * @property int $Estado_N
 * @property int $usuario_Codigo_SIS_U
 * @property int $reporte_reserva_Id_RR
 * 
 * @property ReporteReserva $reporte_reserva
 * @property User $user
 *
 * @package App\Models
 */
class Notificacion extends Model
{
	protected $table = 'notificacion';
	public $timestamps = false;

	protected $casts = [
		'Estado_N' => 'int',
		'usuario_Codigo_SIS_U' => 'int',
		'reporte_reserva_Id_RR' => 'int'
	];

	protected $fillable = [
		'Estado_N'
	];

	public function reporte_reserva()
	{
		return $this->belongsTo(ReporteReserva::class, 'reporte_reserva_Id_RR');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'usuario_Codigo_SIS_U');
	}
}
