<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UsuarioReporte
 * 
 * @property int $Id_RR_UR
 * @property int $usuario_Codigo_SIS_U
 * 
 * @property ReporteReserva $reporte_reserva
 * @property User $user
 *
 * @package App\Models
 */
class UsuarioReporte extends Model
{
	protected $table = 'usuario_reporte';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'Id_RR_UR' => 'int',
		'usuario_Codigo_SIS_U' => 'int'
	];

	public function reporte_reserva()
	{
		return $this->belongsTo(ReporteReserva::class, 'Id_RR_UR');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'usuario_Codigo_SIS_U');
	}
}
