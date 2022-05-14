<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class HorarioLibre
 * 
 * @property int $Id_HL
 * @property Carbon $Hora_Inicio_HL
 * @property string $Dia_HL
 * @property string $aula_Id_A
 * 
 * @property Aula $aula
 *
 * @package App\Models
 */
class HorarioLibre extends Model
{
	protected $table = 'horario_libre';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'Id_HL' => 'int'
	];

	protected $dates = [
		'Hora_Inicio_HL'
	];

	protected $fillable = [
		'Hora_Inicio_HL',
		'Dia_HL'
	];

	public function aula()
	{
		return $this->belongsTo(Aula::class, 'aula_Id_A');
	}
}
