<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Agencia
 * 
 * @property int $agn_id
 * @property string $agn_nombre_corto
 * @property string $agn_nombre
 * @property string $agn_direccion
 * @property string|null $agn_direccion_2
 * @property string $agn_cp
 * @property int $loc_id
 * @property int $prv_id
 * @property int $pais_id
 * @property string|null $agn_contacto_1
 * @property string|null $agn_cnt_apell_1
 * @property string|null $agn_cnt_mail_1
 * @property string|null $agn_cnt_func_1
 * @property string|null $agn_cnt_apell_2
 * @property string|null $agn_contacto_2
 * @property string|null $agn_cnt_mail_2
 * @property string|null $agn_cnt_func_2
 * @property string $agn_telefono
 * @property string|null $agn_fax
 * @property string|null $agn_condiciones
 * @property string|null $agn_funcionamiento
 * @property int $active
 * 
 * @property Localidade $localidade
 * @property Provincia $provincia
 * @property Paise $paise
 *
 * @package App\Models
 */
class Agencia extends Model
{
	protected $table = 'agencias';
	protected $primaryKey = 'agn_id';
	public $timestamps = false;

	protected $casts = [
		'loc_id' => 'int',
		'prv_id' => 'int',
		'pais_id' => 'int',
		'active' => 'int'
	];

	protected $fillable = [
		'agn_nombre_corto',
		'agn_nombre',
		'agn_direccion',
		'agn_direccion_2',
		'agn_cp',
		'loc_id',
		'prv_id',
		'pais_id',
		'agn_contacto_1',
		'agn_cnt_apell_1',
		'agn_cnt_mail_1',
		'agn_cnt_func_1',
		'agn_cnt_apell_2',
		'agn_contacto_2',
		'agn_cnt_mail_2',
		'agn_cnt_func_2',
		'agn_telefono',
		'agn_fax',
		'agn_condiciones',
		'agn_funcionamiento',
		'active'
	];

	public function localidade()
	{
		return $this->belongsTo(Localidade::class, 'loc_id');
	}

	public function provincia()
	{
		return $this->belongsTo(Provincia::class, 'prv_id');
	}

	public function paise()
	{
		return $this->belongsTo(Paise::class, 'pais_id');
	}
}
