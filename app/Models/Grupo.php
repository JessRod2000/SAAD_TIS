<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Grupo
 * 
 * @property string $Id_G
 * @property int $Asignado_G
 * @property int $materia_Codigo_M
 * 
 * @property Materium $materium
 *
 * @package App\Models
 */
class Grupo extends Model
{
	protected $table = 'grupo';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'Asignado_G' => 'int',
		'materia_Codigo_M' => 'int'
	];

	protected $fillable = [
		'Asignado_G'
	];

	public function materium()
	{
		return $this->belongsTo(Materium::class, 'materia_Codigo_M');
	}
}
