<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UsuarioSolicitud
 * 
 * @property int $Id_SR_US
 * @property int $usuario_Codigo_SIS_U
 * 
 * @property SolicitudReserva $solicitud_reserva
 * @property User $user
 *
 * @package App\Models
 */
class UsuarioSolicitud extends Model
{
	protected $table = 'usuario_solicitud';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'Id_SR_US' => 'int',
		'usuario_Codigo_SIS_U' => 'int'
	];

	public function solicitud_reserva()
	{
		return $this->belongsTo(SolicitudReserva::class, 'Id_SR_US');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'usuario_Codigo_SIS_U');
	}
}
