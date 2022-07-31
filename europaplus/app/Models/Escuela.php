<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Escuela
 * 
 * @property int $esc_id
 * @property string $esc_nombre
 * @property string $esc_nombre_corto
 * @property string $esc_direccion
 * @property string $esc_email
 * @property string $esc_telefono
 * @property string $esc_fax
 * @property string $esc_cp
 * @property int $idi_id
 * @property int $loc_id
 * @property int $prv_id
 * @property int $pais_id
 * @property string|null $esc_contacto_1
 * @property string|null $esc_cnt_mail_1
 * @property string|null $esc_cnt_func_1
 * @property string|null $esc_contacto_2
 * @property string|null $esc_cnt_mail_2
 * @property string|null $esc_cnt_func_2
 * @property string|null $esc_contacto_3
 * @property string|null $esc_cnt_mail_3
 * @property string|null $esc_cnt_func_3
 * @property string|null $esc_contacto_4
 * @property string|null $esc_cnt_mail_4
 * @property string|null $esc_cnt_func_4
 * @property string|null $esc_contacto_5
 * @property string|null $esc_cnt_mail_5
 * @property string|null $esc_cnt_func_5
 * @property string|null $esc_condiciones
 * @property string|null $esc_grupo
 * @property int $active
 * @property string|null $esc_direccion_1
 * @property string|null $esc_www
 * @property string|null $esc_usuario
 * @property string|null $esc_password
 * @property string|null $esc_nombre_banco
 * @property string|null $esc_dir_banco
 * @property string|null $esc_iban
 * @property string|null $esc_bic
 * @property string|null $esc_tel_emergencia
 * @property string|null $esc_cnt_tel_1
 * @property string|null $esc_cnt_tel_2
 * @property string|null $esc_cnt_tel_3
 * @property string|null $esc_cnt_tel_4
 * 
 * @property Localidade $localidade
 * @property Provincia $provincia
 * @property Paise $paise
 * @property Opcione $opcione
 * @property Collection|Alojamiento[] $alojamientos
 * @property Collection|Curso[] $cursos
 * @property Collection|Operacione[] $operaciones
 * @property Collection|Suplemento[] $suplementos
 *
 * @package App\Models
 */
class Escuela extends Model
{
	protected $table = 'escuelas';
	protected $primaryKey = 'esc_id';
	public $timestamps = false;

	protected $casts = [
		'idi_id' => 'int',
		'loc_id' => 'int',
		'prv_id' => 'int',
		'pais_id' => 'int',
		'active' => 'int'
	];

	protected $hidden = [
		'esc_password'
	];

	protected $fillable = [
		'esc_nombre',
		'esc_nombre_corto',
		'esc_direccion',
		'esc_email',
		'esc_telefono',
		'esc_fax',
		'esc_cp',
		'idi_id',
		'loc_id',
		'prv_id',
		'pais_id',
		'esc_contacto_1',
		'esc_cnt_mail_1',
		'esc_cnt_func_1',
		'esc_contacto_2',
		'esc_cnt_mail_2',
		'esc_cnt_func_2',
		'esc_contacto_3',
		'esc_cnt_mail_3',
		'esc_cnt_func_3',
		'esc_contacto_4',
		'esc_cnt_mail_4',
		'esc_cnt_func_4',
		'esc_contacto_5',
		'esc_cnt_mail_5',
		'esc_cnt_func_5',
		'esc_condiciones',
		'esc_grupo',
		'active',
		'esc_direccion_1',
		'esc_www',
		'esc_usuario',
		'esc_password',
		'esc_nombre_banco',
		'esc_dir_banco',
		'esc_iban',
		'esc_bic',
		'esc_tel_emergencia',
		'esc_cnt_tel_1',
		'esc_cnt_tel_2',
		'esc_cnt_tel_3',
		'esc_cnt_tel_4'
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

	public function opcione()
	{
		return $this->belongsTo(Opcione::class, 'idi_id');
	}

	public function alojamientos()
	{
		return $this->belongsToMany(Alojamiento::class, 'alojamientos_escuelas', 'esc_id', 'alj_id');
	}

	public function cursos()
	{
		return $this->belongsToMany(Curso::class, 'cursos_escuelas', 'esc_id', 'cur_id');
	}

	public function operaciones()
	{
		return $this->hasMany(Operacione::class, 'esc_id');
	}

	public function suplementos()
	{
		return $this->belongsToMany(Suplemento::class, 'suplementos_escuelas', 'esc_id', 'sup_id');
	}
}
