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
 * @property Carbon $HoraInic_HL
 * @property Carbon $HoraFina_HL
 * @property string $Dia_HL
 * @property string $Codi_A_HL
 * 
 * @property Aula $aula
 *
 * @package App\Models
 */
class HorarioLibre extends Model
{
	protected $table = 'horario_libre';
	protected $primaryKey = 'Id_HL';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'Id_HL' => 'int'
	];

	protected $dates = [
		'HoraInic_HL',
		'HoraFina_HL'
	];

	protected $fillable = [
		'HoraInic_HL',
		'HoraFina_HL',
		'Dia_HL',
		'Codi_A_HL'
	];

	public function aula()
	{
		return $this->belongsTo(Aula::class, 'Codi_A_HL');
	}
}
