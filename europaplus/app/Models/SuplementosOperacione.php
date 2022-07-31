<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SuplementosOperacione
 * 
 * @property int $sop_id
 * @property int $sup_id
 * @property int $opr_id
 * @property float $precio_unidad
 * @property int|null $num_dias
 * @property int|null $num_semanas
 * @property int $sup_tipo
 * 
 * @property Suplemento $suplemento
 * @property Operacione $operacione
 *
 * @package App\Models
 */
class SuplementosOperacione extends Model
{
	protected $table = 'suplementos_operaciones';
	protected $primaryKey = 'sop_id';
	public $timestamps = false;

	protected $casts = [
		'sup_id' => 'int',
		'opr_id' => 'int',
		'precio_unidad' => 'float',
		'num_dias' => 'int',
		'num_semanas' => 'int',
		'sup_tipo' => 'int'
	];

	protected $fillable = [
		'sup_id',
		'opr_id',
		'precio_unidad',
		'num_dias',
		'num_semanas',
		'sup_tipo'
	];

	public function suplemento()
	{
		return $this->belongsTo(Suplemento::class, 'sup_id');
	}

	public function operacione()
	{
		return $this->belongsTo(Operacione::class, 'opr_id');
	}
}
