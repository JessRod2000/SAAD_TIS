<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class GrupoSolicitudReserva
 * 
 * @property string $id_G
 * @property int $solicitud_reserva_Id_SR
 * @property int $solicitud_reserva_materia_SisM_M
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
		'solicitud_reserva_Id_SR' => 'int',
		'solicitud_reserva_materia_SisM_M' => 'int'
	];

	public function solicitud_reserva()
	{
		return $this->belongsTo(SolicitudReserva::class, 'solicitud_reserva_Id_SR')
					->where('solicitud_reserva.Id_SR', '=', 'grupo_solicitud_reserva.solicitud_reserva_Id_SR')
					->where('solicitud_reserva.materia_SisM_M', '=', 'grupo_solicitud_reserva.solicitud_reserva_materia_SisM_M');
	}
}
