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
 * @property int $SisM_M
 * @property string $Nomb_M
 * 
 * @property Collection|Grupo[] $grupos
 * @property Collection|SolicitudReserva[] $solicitud_reservas
 * @property UsuarioMaterium $usuario_materium
 *
 * @package App\Models
 */
class Materium extends Model
{
	protected $table = 'materia';
	protected $primaryKey = 'SisM_M';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'SisM_M' => 'int'
	];

	protected $fillable = [
		'Nomb_M'
	];

	public function grupos()
	{
		return $this->hasMany(Grupo::class, 'materia_SisM_M');
	}

	public function solicitud_reservas()
	{
		return $this->hasMany(SolicitudReserva::class, 'materia_SisM_M');
	}

	public function usuario_materium()
	{
		return $this->hasOne(UsuarioMaterium::class, 'materia_SisM_M');
	}
}
