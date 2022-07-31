<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Operacione
 * 
 * @property int $opr_id
 * @property int $alu_id
 * @property int $esc_id
 * @property int|null $vje_id
 * @property int $cur_id
 * @property float $cur_precio
 * @property float $cur_coste
 * @property Carbon $cur_fecha_inicio
 * @property Carbon $cur_fecha_fin
 * @property int $cur_semanas
 * @property int|null $alj_id
 * @property Carbon|null $alj_fecha_inicio
 * @property Carbon|null $alj_fecha_fin
 * @property float|null $alj_precio
 * @property float|null $alj_coste
 * @property Carbon $opr_fecha
 * @property int $opr_cur_state
 * @property int $opr_vje_state
 * @property int $opr_tfr_state
 * @property int $opr_descr_state
 * @property int $opr_confirm_state
 * @property int $opr_entrega_state
 * @property float $opr_pago_previo
 * @property float $opr_pendiente
 * @property int $opr_seguro
 * @property string|null $opr_comentarios
 * @property string|null $opr_comentarios_esc
 * @property string|null $opr_cmntsalu
 * @property string|null $opr_cmntsalj
 * @property int $opr_state
 * @property float $opr_descuento
 * @property float $opr_ttl_coste
 * @property int|null $opr_empresa
 * @property int|null $opr_agencia
 * @property int $opr_modificada
 * @property float $opr_ttl_coste_h
 * @property int $opr_modificada_tfr
 * @property int $opr_cancelada
 * @property int $opr_alutoint
 * @property int|null $opr_year
 * @property float $opr_apagar
 * @property Carbon|null $cur_fecha_pagprov
 * 
 * @property Alumno $alumno
 * @property Escuela $escuela
 * @property Curso $curso
 * @property Collection|Factura[] $facturas
 * @property Collection|Pago[] $pagos
 * @property Collection|Suplemento[] $suplementos
 * @property Collection|Viaje[] $viajes
 *
 * @package App\Models
 */
class Operacione extends Model
{
	protected $table = 'operaciones';
	protected $primaryKey = 'opr_id';
	public $timestamps = false;

	protected $casts = [
		'alu_id' => 'int',
		'esc_id' => 'int',
		'vje_id' => 'int',
		'cur_id' => 'int',
		'cur_precio' => 'float',
		'cur_coste' => 'float',
		'cur_semanas' => 'int',
		'alj_id' => 'int',
		'alj_precio' => 'float',
		'alj_coste' => 'float',
		'opr_cur_state' => 'int',
		'opr_vje_state' => 'int',
		'opr_tfr_state' => 'int',
		'opr_descr_state' => 'int',
		'opr_confirm_state' => 'int',
		'opr_entrega_state' => 'int',
		'opr_pago_previo' => 'float',
		'opr_pendiente' => 'float',
		'opr_seguro' => 'int',
		'opr_state' => 'int',
		'opr_descuento' => 'float',
		'opr_ttl_coste' => 'float',
		'opr_empresa' => 'int',
		'opr_agencia' => 'int',
		'opr_modificada' => 'int',
		'opr_ttl_coste_h' => 'float',
		'opr_modificada_tfr' => 'int',
		'opr_cancelada' => 'int',
		'opr_alutoint' => 'int',
		'opr_year' => 'int',
		'opr_apagar' => 'float'
	];

	protected $dates = [
		'cur_fecha_inicio',
		'cur_fecha_fin',
		'alj_fecha_inicio',
		'alj_fecha_fin',
		'opr_fecha',
		'cur_fecha_pagprov'
	];

	protected $fillable = [
		'alu_id',
		'esc_id',
		'vje_id',
		'cur_id',
		'cur_precio',
		'cur_coste',
		'cur_fecha_inicio',
		'cur_fecha_fin',
		'cur_semanas',
		'alj_id',
		'alj_fecha_inicio',
		'alj_fecha_fin',
		'alj_precio',
		'alj_coste',
		'opr_fecha',
		'opr_cur_state',
		'opr_vje_state',
		'opr_tfr_state',
		'opr_descr_state',
		'opr_confirm_state',
		'opr_entrega_state',
		'opr_pago_previo',
		'opr_pendiente',
		'opr_seguro',
		'opr_comentarios',
		'opr_comentarios_esc',
		'opr_cmntsalu',
		'opr_cmntsalj',
		'opr_state',
		'opr_descuento',
		'opr_ttl_coste',
		'opr_empresa',
		'opr_agencia',
		'opr_modificada',
		'opr_ttl_coste_h',
		'opr_modificada_tfr',
		'opr_cancelada',
		'opr_alutoint',
		'opr_year',
		'opr_apagar',
		'cur_fecha_pagprov'
	];

	public function alumno()
	{
		return $this->belongsTo(Alumno::class, 'alu_id');
	}

	public function escuela()
	{
		return $this->belongsTo(Escuela::class, 'esc_id');
	}

	public function curso()
	{
		return $this->belongsTo(Curso::class, 'cur_id');
	}

	public function facturas()
	{
		return $this->hasMany(Factura::class, 'opr_id');
	}

	public function pagos()
	{
		return $this->hasMany(Pago::class, 'opr_id');
	}

	public function suplementos()
	{
		return $this->belongsToMany(Suplemento::class, 'suplementos_operaciones', 'opr_id', 'sup_id')
					->withPivot('sop_id', 'precio_unidad', 'num_dias', 'num_semanas', 'sup_tipo');
	}

	public function viajes()
	{
		return $this->hasMany(Viaje::class, 'opr_id');
	}
}
