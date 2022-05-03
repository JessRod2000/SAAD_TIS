<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 * 
 * @property int $id
 * @property int $Codigo_SIS_U
 * @property string $Nombre_U
 * @property string $Contrasenia_U
 * @property string|null $Correo_U
 * @property string $Apelllido_Paterno_U
 * @property string|null $Apellido_Materno_U
 * @property int $Rol_U
 * 
 * @property Collection|Notificacion[] $notificacions
 * @property UsuarioMaterium $usuario_materium
 * @property Collection|UsuarioReporte[] $usuario_reportes
 * @property Collection|UsuarioSolicitud[] $usuario_solicituds
 *
 * @package App\Models
 */
class User extends Model
{
	protected $table = 'users';
	protected $primaryKey = 'Codigo_SIS_U';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'Codigo_SIS_U' => 'int',
		'Rol_U' => 'int'
	];

	protected $fillable = [
		'id',
		'Nombre_U',
		'Contrasenia_U',
		'Correo_U',
		'Apelllido_Paterno_U',
		'Apellido_Materno_U',
		'Rol_U'
	];

	public function notificacions()
	{
		return $this->hasMany(Notificacion::class, 'usuario_Codigo_SIS_U');
	}

	public function usuario_materium()
	{
		return $this->hasOne(UsuarioMaterium::class, 'usuario_Codigo_SIS_U');
	}

	public function usuario_reportes()
	{
		return $this->hasMany(UsuarioReporte::class, 'usuario_Codigo_SIS_U');
	}

	public function usuario_solicituds()
	{
		return $this->hasMany(UsuarioSolicitud::class, 'usuario_Codigo_SIS_U');
	}
}
