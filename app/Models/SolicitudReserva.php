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
 * @property int $materia_Codigo_M
 * @property Carbon $Fecha_SR
 * @property Carbon $Hora_Inicio_SR
 * @property int $Cantidad_Periodos_SR
 * @property int $Numero_Estudiantes_SR
 * @property int $Estado_Atendido_SR
 * @property string $Motivo_SR
 * @property Carbon $Hora_Final_SR
 * @property Carbon $Creado_en_SR
 * @property int $periodo_academico_Id_PA
 * 
 * @property Materium $materium
 * @property PeriodoAcademico $periodo_academico
 * @property Collection|ReporteReserva[] $reporte_reservas
 * @property Collection|UsuarioSolicitud[] $usuario_solicituds
 *
 * @package App\Models
 */
class SolicitudReserva extends Model
{
	protected $table = 'solicitud_reserva';
	protected $primaryKey = 'Id_SR';
	public $timestamps = false;

	protected $casts = [
		'materia_Codigo_M' => 'int',
		'Cantidad_Periodos_SR' => 'int',
		'Numero_Estudiantes_SR' => 'int',
		'Estado_Atendido_SR' => 'int',
		'periodo_academico_Id_PA' => 'int'
	];

	protected $dates = [
		'Fecha_SR',
		'Hora_Inicio_SR',
		'Hora_Final_SR',
		'Creado_en_SR'
	];

	protected $fillable = [
		'materia_Codigo_M',
		'Fecha_SR',
		'Hora_Inicio_SR',
		'Cantidad_Periodos_SR',
		'Numero_Estudiantes_SR',
		'Estado_Atendido_SR',
		'Motivo_SR',
		'Hora_Final_SR',
		'Creado_en_SR',
		'periodo_academico_Id_PA'
	];

	public function materium()
	{
		return $this->belongsTo(Materium::class, 'materia_Codigo_M');
	}

	public function periodo_academico()
	{
		return $this->belongsTo(PeriodoAcademico::class, 'periodo_academico_Id_PA');
	}

	public function reporte_reservas()
	{
		return $this->hasMany(ReporteReserva::class, 'solicitud_reserva_Id_SR');
	}

	public function usuario_solicituds()
	{
		return $this->hasMany(UsuarioSolicitud::class, 'solicitud_reserva_Id_SR');
	}
}
