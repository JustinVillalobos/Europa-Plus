<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Pago
 * 
 * @property int $pag_id
 * @property int $opr_id
 * @property int $fac_id
 * @property float $pag_importe
 * @property int $pag_tipo
 * @property int $pag_signo
 * 
 * @property Operacione $operacione
 * @property Factura $factura
 *
 * @package App\Models
 */
class Pago extends Model
{
	protected $table = 'pagos';
	protected $primaryKey = 'pag_id';
	public $timestamps = false;

	protected $casts = [
		'opr_id' => 'int',
		'fac_id' => 'int',
		'pag_importe' => 'float',
		'pag_tipo' => 'int',
		'pag_signo' => 'int'
	];

	protected $fillable = [
		'opr_id',
		'fac_id',
		'pag_importe',
		'pag_tipo',
		'pag_signo'
	];

	public function operacione()
	{
		return $this->belongsTo(Operacione::class, 'opr_id');
	}

	public function factura()
	{
		return $this->belongsTo(Factura::class, 'fac_id');
	}
}
