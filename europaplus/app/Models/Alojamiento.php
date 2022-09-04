<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Alojamiento
 * 
 * @property int $alj_id
 * @property string $alj_nombre
 * @property string $alj_descr
 * @property string|null $alj_descr_de
 * @property int $active
 * @property string|null $alj_descr_en
 * @property int $tipo_id
 * 
 * @property Tipo $tipo
 * @property Collection|Escuela[] $escuelas
 *
 * @package App\Models
 */
class Alojamiento extends Model
{
	protected $table = 'alojamientos';
	protected $primaryKey = 'alj_id';
	public $timestamps = false;

	protected $casts = [
		'active' => 'int',
		'tipo_id' => 'int'
	];

	protected $fillable = [
		'alj_nombre',
		'alj_descr',
		'alj_descr_de',
		'active',
		'alj_descr_en',
		'tipo_id'
	];

	public function tipo()
	{
		return $this->belongsTo(Tipo::class);
	}

	public function escuelas()
	{
		return $this->belongsToMany(Escuela::class, 'alojamientos_escuelas', 'alj_id', 'esc_id');
	}
}
