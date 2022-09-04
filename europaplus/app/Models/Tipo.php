<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Tipo
 * 
 * @property int $tipo_id
 * @property string $tipo_descripcion
 * @property int $tipo_porcentaje
 * @property int $tipo_tipo
 * 
 * @property Collection|Alojamiento[] $alojamientos
 * @property Collection|Curso[] $cursos
 *
 * @package App\Models
 */
class Tipo extends Model
{
	protected $table = 'tipos';
	protected $primaryKey = 'tipo_id';
	public $timestamps = false;

	protected $casts = [
		'tipo_porcentaje' => 'int',
		'tipo_tipo' => 'int'
	];

	protected $fillable = [
		'tipo_descripcion',
		'tipo_porcentaje',
		'tipo_tipo'
	];

	public function alojamientos()
	{
		return $this->hasMany(Alojamiento::class);
	}

	public function cursos()
	{
		return $this->hasMany(Curso::class);
	}
}
