<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Empresa
 * 
 * @property int $emp_id
 * @property string $emp_nombre
 * @property string $emp_nombre_corto
 * @property string $emp_direccion
 * @property string|null $emp_direccion_2
 * @property string $emp_cp
 * @property string $emp_cif
 * @property string|null $emp_proveedor
 * @property string|null $emp_contacto_1
 * @property string|null $emp_cnt_apell_1
 * @property string|null $emp_cnt_mail_1
 * @property string|null $emp_telefono_1
 * @property string $emp_cnt_func_1
 * @property string|null $emp_contacto_2
 * @property string|null $emp_cnt_apell_2
 * @property string|null $emp_cnt_mail_2
 * @property string|null $emp_telefono_2
 * @property string $emp_cnt_func_2
 * @property string|null $emp_fax
 * @property int $active
 * @property int $pais_id
 * @property int $prv_id
 * @property int $loc_id
 * @property string|null $emp_telefono
 * 
 * @property Paise $paise
 * @property Provincia $provincia
 * @property Localidade $localidade
 *
 * @package App\Models
 */
class Empresa extends Model
{
	protected $table = 'empresas';
	protected $primaryKey = 'emp_id';
	public $timestamps = false;

	protected $casts = [
		'active' => 'int',
		'pais_id' => 'int',
		'prv_id' => 'int',
		'loc_id' => 'int'
	];

	protected $fillable = [
		'emp_nombre',
		'emp_nombre_corto',
		'emp_direccion',
		'emp_direccion_2',
		'emp_cp',
		'emp_cif',
		'emp_proveedor',
		'emp_contacto_1',
		'emp_cnt_apell_1',
		'emp_cnt_mail_1',
		'emp_telefono_1',
		'emp_cnt_func_1',
		'emp_contacto_2',
		'emp_cnt_apell_2',
		'emp_cnt_mail_2',
		'emp_telefono_2',
		'emp_cnt_func_2',
		'emp_fax',
		'active',
		'pais_id',
		'prv_id',
		'loc_id',
		'emp_telefono'
	];

	public function paise()
	{
		return $this->belongsTo(Paise::class, 'pais_id');
	}

	public function provincia()
	{
		return $this->belongsTo(Provincia::class, 'prv_id');
	}

	public function localidade()
	{
		return $this->belongsTo(Localidade::class, 'loc_id');
	}
}
