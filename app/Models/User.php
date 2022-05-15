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
 * @property int $Codigo_SIS_U
 * @property string $Nombre_U
 * @property string $Contrasenia_U
 * @property string $Correo_U
 * @property string $Apellido_Paterno_U
 * @property string $Apellido_Materno_U
 * @property int $Rol_U
 * 
 * @property Collection|ReporteReserva[] $reporte_reservas
 * @property Collection|UsuarioMaterium[] $usuario_materia
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
		'Codigo_SIS_U' => 'int',
		'Rol_U' => 'int'
	];

	protected $fillable = [
		'Nombre_U',
		'Contrasenia_U',
		'Correo_U',
		'Apellido_Paterno_U',
		'Apellido_Materno_U',
		'Rol_U'
	];

	public function reporte_reservas()
	{
		return $this->hasMany(ReporteReserva::class, 'usuario_Codigo_SIS_U');
	}

	public function usuario_materia()
	{
		return $this->hasMany(UsuarioMaterium::class, 'usuario_Codigo_SIS_U');
	}

	public function usuario_solicituds()
	{
		return $this->hasMany(UsuarioSolicitud::class, 'usuarios_Codigo_SIS_U');
	}
}
