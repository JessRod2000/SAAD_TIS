<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Funcion
 * 
 * @property int $Id_F
 * @property string $Nombre_F
 * 
 * @property Collection|Rol[] $rols
 *
 * @package App\Models
 */
class Funcion extends Model
{
	protected $table = 'funcion';
	protected $primaryKey = 'Id_F';
	public $timestamps = false;

	protected $fillable = [
		'Nombre_F'
	];

	public function rols()
	{
		return $this->belongsToMany(Rol::class, 'funcion_rol', 'Funcion_Id_F', 'Rol_Id_R');
	}
}
