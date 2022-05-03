<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UsuarioMaterium
 * 
 * @property string $Grupo_UM
 * @property int $asignado_UM
 * @property int $materia_SisM_M
 * @property int $usuario_Codigo_SIS_U
 * 
 * @property Materium $materium
 * @property User $user
 *
 * @package App\Models
 */
class UsuarioMaterium extends Model
{
	protected $table = 'usuario_materia';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'asignado_UM' => 'int',
		'materia_SisM_M' => 'int',
		'usuario_Codigo_SIS_U' => 'int'
	];

	protected $fillable = [
		'Grupo_UM',
		'asignado_UM',
		'materia_SisM_M',
		'usuario_Codigo_SIS_U'
	];

	public function materium()
	{
		return $this->belongsTo(Materium::class, 'materia_SisM_M');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'usuario_Codigo_SIS_U');
	}
}
