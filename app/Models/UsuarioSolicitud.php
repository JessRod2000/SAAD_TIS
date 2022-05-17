<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UsuarioSolicitud
 * 
 * @property int $solicitud_reserva_Id_SR
 * @property int $usuarios_Codigo_SIS_U
 * @property string $Id_G_US
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
		'solicitud_reserva_Id_SR' => 'int',
		'usuarios_Codigo_SIS_U' => 'int'
	];

	public function solicitud_reserva()
	{
		return $this->belongsTo(SolicitudReserva::class, 'solicitud_reserva_Id_SR');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'usuarios_Codigo_SIS_U');
	}
}
