<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SolicitudReserva
 * 
 * @property int $Id_SR
 * @property int $materia_SisM_M
 * @property Carbon $Fecha_SR
 * @property Carbon $Hora_Inicio_SR
 * @property int $Cantidad_Periodos_SR
 * @property int $Numero_Estudiantes_SR
 * @property int $Estado_Atendido_SR
 * @property string $Motivo_SR
 * @property Carbon $Hora_Final_SR
 * @property Carbon|null $Creado_en_SR
 * 
 * @property Materium $materium
 * @property Collection|GrupoSolicitudReserva[] $grupo_solicitud_reservas
 * @property Collection|ReporteReserva[] $reporte_reservas
 * @property Collection|UsuarioSolicitud[] $usuario_solicituds
 *
 * @package App\Models
 */
class SolicitudReserva extends Model
{
	protected $table = 'solicitud_reserva';
	public $timestamps = false;

	protected $casts = [
		'materia_SisM_M' => 'int',
		'Cantidad_Periodos_SR' => 'int',
		'Numero_Estudiantes_SR' => 'int',
		'Estado_Atendido_SR' => 'int'
	];

	protected $dates = [
		'Fecha_SR',
		'Hora_Inicio_SR',
		'Hora_Final_SR',
		'Creado_en_SR'
	];

	protected $fillable = [
		'Fecha_SR',
		'Hora_Inicio_SR',
		'Cantidad_Periodos_SR',
		'Numero_Estudiantes_SR',
		'Estado_Atendido_SR',
		'Motivo_SR',
		'Hora_Final_SR',
		'Creado_en_SR'
	];

	public function materium()
	{
		return $this->belongsTo(Materium::class, 'materia_SisM_M');
	}

	public function grupo_solicitud_reservas()
	{
		return $this->hasMany(GrupoSolicitudReserva::class, 'solicitud_reserva_Id_SR');
	}

	public function reporte_reservas()
	{
		return $this->hasMany(ReporteReserva::class, 'Id_SR_RR');
	}

	public function usuario_solicituds()
	{
		return $this->hasMany(UsuarioSolicitud::class, 'Id_SR_US');
	}
}
