<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Rol
 * 
 * @property int $Id_R
 * @property string $Nombre_R
 * 
 * @property Collection|Funcion[] $funcions
 * @property RolUsuario $rol_usuario
 *
 * @package App\Models
 */
class Rol extends Model
{
	protected $table = 'rol';
	protected $primaryKey = 'Id_R';
	public $timestamps = false;

	protected $fillable = [
		'Nombre_R'
	];

	public function funcions()
	{
		return $this->belongsToMany(Funcion::class, 'funcion_rol', 'Rol_Id_R', 'Funcion_Id_F');
	}

	public function rol_usuario()
	{
		return $this->hasOne(RolUsuario::class, 'Rol_Id_R');
	}
}
