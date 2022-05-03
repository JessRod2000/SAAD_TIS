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
 * @property string $Titu_N
 * @property int $Leid_N
 * @property int $Id_RR_N
 * @property int $usuario_Codigo_SIS_U
 * 
 * @property ReporteReserva $reporte_reserva
 * @property User $user
 *
 * @package App\Models
 */
class Notificacion extends Model
{
	protected $table = 'notificacion';
	protected $primaryKey = 'Id_N';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'Id_N' => 'int',
		'Leid_N' => 'int',
		'Id_RR_N' => 'int',
		'usuario_Codigo_SIS_U' => 'int'
	];

	protected $fillable = [
		'Titu_N',
		'Leid_N',
		'Id_RR_N',
		'usuario_Codigo_SIS_U'
	];

	public function reporte_reserva()
	{
		return $this->belongsTo(ReporteReserva::class, 'Id_RR_N');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'usuario_Codigo_SIS_U');
	}
}
