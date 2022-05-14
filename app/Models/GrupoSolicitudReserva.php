<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class GrupoSolicitudReserva
 * 
 * @property string $Id_Grupo_GSR
 * @property int $solicitud_reserva_Id_SR
 * 
 * @property SolicitudReserva $solicitud_reserva
 *
 * @package App\Models
 */
class GrupoSolicitudReserva extends Model
{
	protected $table = 'grupo_solicitud_reserva';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'solicitud_reserva_Id_SR' => 'int'
	];

	public function solicitud_reserva()
	{
		return $this->belongsTo(SolicitudReserva::class, 'solicitud_reserva_Id_SR');
	}
}
