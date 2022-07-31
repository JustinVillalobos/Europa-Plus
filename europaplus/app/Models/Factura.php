<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Factura
 * 
 * @property int $fac_id
 * @property int $opr_id
 * @property int $fac_num
 * @property string $fac_serie
 * @property string $fac_numero
 * @property string $fac_fecha
 * @property float $fac_cantidad
 * @property float|null $fac_porcentaje_descuento
 * @property float|null $fac_descuento
 * @property string $fac_concepto
 * @property string|null $fac_nombre
 * @property string|null $fac_apellidos
 * @property string|null $fac_direccion
 * @property string|null $fac_direccion_2
 * @property string|null $fac_cp
 * @property string|null $fac_localidad
 * @property string|null $fac_provincia
 * @property string|null $fac_pais
 * @property string|null $fac_cif
 * @property string|null $fac_nombre_empresa
 * @property string|null $fac_contacto_empresa
 * @property string|null $fac_direccion_empresa
 * @property string|null $fac_direccion_empresa_2
 * @property string|null $fac_cp_empresa
 * @property string|null $fac_localidad_empresa
 * @property string|null $fac_provincia_empresa
 * @property string|null $fac_pais_empresa
 * @property string|null $fac_cif_empresa
 * @property string $fac_alumno
 * @property string $fac_nombre_curso
 * @property string $fac_localidad_curso
 * @property string $fac_pais_curso
 * @property string $fac_fecha_ini_curso
 * @property string $fac_fecha_fin_curso
 * @property string $fac_idioma_curso
 * @property string|null $fac_suplementos_curso
 * @property string|null $fac_comentarios
 * @property int $fac_proforma
 * @property int $fac_cur_semanas
 * 
 * @property Operacione $operacione
 * @property Collection|Pago[] $pagos
 *
 * @package App\Models
 */
class Factura extends Model
{
	protected $table = 'facturas';
	protected $primaryKey = 'fac_id';
	public $timestamps = false;

	protected $casts = [
		'opr_id' => 'int',
		'fac_num' => 'int',
		'fac_cantidad' => 'float',
		'fac_porcentaje_descuento' => 'float',
		'fac_descuento' => 'float',
		'fac_proforma' => 'int',
		'fac_cur_semanas' => 'int'
	];

	protected $fillable = [
		'opr_id',
		'fac_num',
		'fac_serie',
		'fac_numero',
		'fac_fecha',
		'fac_cantidad',
		'fac_porcentaje_descuento',
		'fac_descuento',
		'fac_concepto',
		'fac_nombre',
		'fac_apellidos',
		'fac_direccion',
		'fac_direccion_2',
		'fac_cp',
		'fac_localidad',
		'fac_provincia',
		'fac_pais',
		'fac_cif',
		'fac_nombre_empresa',
		'fac_contacto_empresa',
		'fac_direccion_empresa',
		'fac_direccion_empresa_2',
		'fac_cp_empresa',
		'fac_localidad_empresa',
		'fac_provincia_empresa',
		'fac_pais_empresa',
		'fac_cif_empresa',
		'fac_alumno',
		'fac_nombre_curso',
		'fac_localidad_curso',
		'fac_pais_curso',
		'fac_fecha_ini_curso',
		'fac_fecha_fin_curso',
		'fac_idioma_curso',
		'fac_suplementos_curso',
		'fac_comentarios',
		'fac_proforma',
		'fac_cur_semanas'
	];

	public function operacione()
	{
		return $this->belongsTo(Operacione::class, 'opr_id');
	}

	public function pagos()
	{
		return $this->hasMany(Pago::class, 'fac_id');
	}
}
