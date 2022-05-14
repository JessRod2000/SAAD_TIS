<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Materium
 * 
 * @property int $Codigo_M
 * @property string $Nombre_M
 * 
 * @property Collection|Grupo[] $grupos
 * @property Collection|SolicitudReserva[] $solicitud_reservas
 * @property Collection|UsuarioMaterium[] $usuario_materia
 *
 * @package App\Models
 */
class Materium extends Model
{
	protected $table = 'materia';
	protected $primaryKey = 'Codigo_M';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'Codigo_M' => 'int'
	];

	protected $fillable = [
		'Nombre_M'
	];

	public function grupos()
	{
		return $this->hasMany(Grupo::class, 'materia_Codigo_M');
	}

	public function solicitud_reservas()
	{
		return $this->hasMany(SolicitudReserva::class, 'materia_Codigo_M');
	}

	public function usuario_materia()
	{
		return $this->hasMany(UsuarioMaterium::class, 'materia_Codigo_M');
	}
}
