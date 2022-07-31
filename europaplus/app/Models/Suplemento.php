<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Suplemento
 * 
 * @property int $sup_id
 * @property string $sup_nombre
 * @property int $sup_tipo
 * @property string $sup_descr
 * @property string|null $sup_descr_de
 * @property int $active
 * @property string|null $sup_descr_en
 * 
 * @property Collection|Escuela[] $escuelas
 * @property Collection|Operacione[] $operaciones
 *
 * @package App\Models
 */
class Suplemento extends Model
{
	protected $table = 'suplementos';
	protected $primaryKey = 'sup_id';
	public $timestamps = false;

	protected $casts = [
		'sup_tipo' => 'int',
		'active' => 'int'
	];

	protected $fillable = [
		'sup_nombre',
		'sup_tipo',
		'sup_descr',
		'sup_descr_de',
		'active',
		'sup_descr_en'
	];

	public function escuelas()
	{
		return $this->belongsToMany(Escuela::class, 'suplementos_escuelas', 'sup_id', 'esc_id');
	}

	public function operaciones()
	{
		return $this->belongsToMany(Operacione::class, 'suplementos_operaciones', 'sup_id', 'opr_id')
					->withPivot('sop_id', 'precio_unidad', 'num_dias', 'num_semanas', 'sup_tipo');
	}
}
