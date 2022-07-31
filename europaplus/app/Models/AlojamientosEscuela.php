<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AlojamientosEscuela
 * 
 * @property int $alj_id
 * @property int $esc_id
 * 
 * @property Escuela $escuela
 * @property Alojamiento $alojamiento
 *
 * @package App\Models
 */
class AlojamientosEscuela extends Model
{
	protected $table = 'alojamientos_escuelas';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'alj_id' => 'int',
		'esc_id' => 'int'
	];

	public function escuela()
	{
		return $this->belongsTo(Escuela::class, 'esc_id');
	}

	public function alojamiento()
	{
		return $this->belongsTo(Alojamiento::class, 'alj_id');
	}
}
