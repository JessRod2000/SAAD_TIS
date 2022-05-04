<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Grupo
 * 
 * @property string $id_grupo
 * @property int $materia_SisM_M
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
		'materia_SisM_M' => 'int'
	];

	public function materium()
	{
		return $this->belongsTo(Materium::class, 'materia_SisM_M');
	}
}
