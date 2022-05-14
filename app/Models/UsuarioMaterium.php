<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UsuarioMaterium
 * 
 * @property string $Grupo_UM
 * @property int $Asignado_UM
 * @property Carbon $Fecha_Asignado_UM
 * @property Carbon|null $Fecha_Desasignado_UM
 * @property int $materia_Codigo_M
 * @property int $usuario_Codigo_SIS_U
 * @property int $Id_UM
 * 
 * @property Materium $materium
 * @property User $user
 *
 * @package App\Models
 */
class UsuarioMaterium extends Model
{
	protected $table = 'usuario_materia';
	protected $primaryKey = 'Id_UM';
	public $timestamps = false;

	protected $casts = [
		'Asignado_UM' => 'int',
		'materia_Codigo_M' => 'int',
		'usuario_Codigo_SIS_U' => 'int'
	];

	protected $dates = [
		'Fecha_Asignado_UM',
		'Fecha_Desasignado_UM'
	];

	protected $fillable = [
		'Grupo_UM',
		'Asignado_UM',
		'Fecha_Asignado_UM',
		'Fecha_Desasignado_UM',
		'materia_Codigo_M',
		'usuario_Codigo_SIS_U'
	];

	public function materium()
	{
		return $this->belongsTo(Materium::class, 'materia_Codigo_M');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'usuario_Codigo_SIS_U');
	}
}
