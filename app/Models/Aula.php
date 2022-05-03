<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Aula
 * 
 * @property string $Codi_A
 * @property int $Capa_A
 * 
 * @property Collection|HorarioLibre[] $horario_libres
 * @property Collection|ReporteAula[] $reporte_aulas
 *
 * @package App\Models
 */
class Aula extends Model
{
	protected $table = 'aula';
	protected $primaryKey = 'Codi_A';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'Capa_A' => 'int'
	];

	protected $fillable = [
		'Capa_A'
	];

	public function horario_libres()
	{
		return $this->hasMany(HorarioLibre::class, 'Codi_A_HL');
	}

	public function reporte_aulas()
	{
		return $this->hasMany(ReporteAula::class, 'Codi_A_RA');
	}
}
