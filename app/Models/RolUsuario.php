<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class RolUsuario
 * 
 * @property int $Rol_Id_R
 * @property int $rol_usuario_Codigo_SIS_U
 * @property int $habilitado_R_U
 * @property Carbon $fecha_inicio_R_U
 * @property Carbon|null $fecha_fin_R_U
 * 
 * @property Rol $rol
 * @property User $user
 *
 * @package App\Models
 */
class RolUsuario extends Model
{
	protected $table = 'rol_usuario';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'Rol_Id_R' => 'int',
		'rol_usuario_Codigo_SIS_U' => 'int',
		'habilitado_R_U' => 'int'
	];

	protected $dates = [
		'fecha_inicio_R_U',
		'fecha_fin_R_U'
	];

	protected $fillable = [
		'Rol_Id_R',
		'rol_usuario_Codigo_SIS_U',
		'habilitado_R_U',
		'fecha_inicio_R_U',
		'fecha_fin_R_U'
	];

	public function rol()
	{
		return $this->belongsTo(Rol::class, 'Rol_Id_R');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'rol_usuario_Codigo_SIS_U');
	}
}
