<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class FuncionRol
 * 
 * @property int $Funcion_Id_F
 * @property int $Rol_Id_R
 * 
 * @property Funcion $funcion
 * @property Rol $rol
 *
 * @package App\Models
 */
class FuncionRol extends Model
{
	protected $table = 'funcion_rol';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'Funcion_Id_F' => 'int',
		'Rol_Id_R' => 'int'
	];

	protected $fillable = [
		'Funcion_Id_F',
		'Rol_Id_R'
	];

	public function funcion()
	{
		return $this->belongsTo(Funcion::class, 'Funcion_Id_F');
	}

	public function rol()
	{
		return $this->belongsTo(Rol::class, 'Rol_Id_R');
	}
}
