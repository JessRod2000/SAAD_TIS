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
 * @property int $Acep_RR
 * @property string|null $Obse_RR
 * @property Carbon $FechAten_RR
 * @property Carbon $HoraAten_RR
 * @property int $Id_SR_RR
 * 
 * @property SolicitudReserva $solicitud_reserva
 * @property Collection|Notificacion[] $notificacions
 * @property Collection|ReporteAula[] $reporte_aulas
 * @property Collection|UsuarioReporte[] $usuario_reportes
 *
 * @package App\Models
 */
class ReporteReserva extends Model
{
	protected $table = 'reporte_reserva';
	protected $primaryKey = 'Id_RR';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'Id_RR' => 'int',
		'Acep_RR' => 'int',
		'Id_SR_RR' => 'int'
	];

	protected $dates = [
		'FechAten_RR',
		'HoraAten_RR'
	];

	protected $fillable = [
		'Acep_RR',
		'Obse_RR',
		'FechAten_RR',
		'HoraAten_RR',
		'Id_SR_RR'
	];

	public function solicitud_reserva()
	{
		return $this->belongsTo(SolicitudReserva::class, 'Id_SR_RR');
	}

	public function notificacions()
	{
		return $this->hasMany(Notificacion::class, 'Id_RR_N');
	}

	public function reporte_aulas()
	{
		return $this->hasMany(ReporteAula::class, 'Id_RR_RA');
	}

	public function usuario_reportes()
	{
		return $this->hasMany(UsuarioReporte::class, 'Id_RR_UR');
	}
}
