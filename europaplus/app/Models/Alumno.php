<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Alumno
 * 
 * @property int $alu_id
 * @property int $idi_id
 * @property string $alu_nombre
 * @property string $alu_apellidos
 * @property string|null $alu_email
 * @property string|null $alu_dni
 * @property string $alu_direccion
 * @property string $alu_direccion_1
 * @property string $alu_cp
 * @property string $alu_cp_1
 * @property string $alu_telefono
 * @property string|null $alu_telefono_trabajo
 * @property string|null $alu_telefono_1
 * @property string|null $alu_movil
 * @property string $alu_nombre_contacto
 * @property string $alu_parentesco_contacto
 * @property string $alu_fecha_nacim
 * @property int $alu_edad
 * @property int $alu_sexo
 * @property string|null $alu_profesion
 * @property string|null $alu_empresa
 * @property int $alu_nivel_idioma
 * @property string|null $alu_alergias
 * @property int|null $alu_tol_anim
 * @property string|null $alu_animales
 * @property string|null $alu_nombre_padre
 * @property string|null $alu_tel_padre
 * @property int $alu_medio_contacto
 * @property string|null $alu_comentarios
 * @property int $loc_id
 * @property int $prv_id
 * @property int|null $loc_id_1
 * @property int|null $prv_id_1
 * @property int $pais_id
 * @property int|null $pais_id1
 * @property int|null $emp_id
 * @property int|null $agn_id
 * @property int $active
 * @property int $alu_dieta
 * @property int $alu_fumador
 * @property string|null $alu_dieta_descr
 * @property string|null $alu_dni_fexp
 * @property string|null $alu_dni_fcad
 * 
 * @property Opcione $opcione
 * @property Localidade|null $localidade
 * @property Provincia|null $provincia
 * @property Paise|null $paise
 * @property Collection|Operacione[] $operaciones
 *
 * @package App\Models
 */
class Alumno extends Model
{
	protected $table = 'alumnos';
	protected $primaryKey = 'alu_id';
	public $timestamps = false;

	protected $casts = [
		'idi_id' => 'int',
		'alu_edad' => 'int',
		'alu_sexo' => 'int',
		'alu_nivel_idioma' => 'int',
		'alu_tol_anim' => 'int',
		'alu_medio_contacto' => 'int',
		'loc_id' => 'int',
		'prv_id' => 'int',
		'loc_id_1' => 'int',
		'prv_id_1' => 'int',
		'pais_id' => 'int',
		'pais_id1' => 'int',
		'emp_id' => 'int',
		'agn_id' => 'int',
		'active' => 'int',
		'alu_dieta' => 'int',
		'alu_fumador' => 'int'
	];

	protected $fillable = [
		'idi_id',
		'alu_nombre',
		'alu_apellidos',
		'alu_email',
		'alu_dni',
		'alu_direccion',
		'alu_direccion_1',
		'alu_cp',
		'alu_cp_1',
		'alu_telefono',
		'alu_telefono_trabajo',
		'alu_telefono_1',
		'alu_movil',
		'alu_nombre_contacto',
		'alu_parentesco_contacto',
		'alu_fecha_nacim',
		'alu_edad',
		'alu_sexo',
		'alu_profesion',
		'alu_empresa',
		'alu_nivel_idioma',
		'alu_alergias',
		'alu_tol_anim',
		'alu_animales',
		'alu_nombre_padre',
		'alu_tel_padre',
		'alu_medio_contacto',
		'alu_comentarios',
		'loc_id',
		'prv_id',
		'loc_id_1',
		'prv_id_1',
		'pais_id',
		'pais_id1',
		'emp_id',
		'agn_id',
		'active',
		'alu_dieta',
		'alu_fumador',
		'alu_dieta_descr',
		'alu_dni_fexp',
		'alu_dni_fcad'
	];

	public function opcione()
	{
		return $this->belongsTo(Opcione::class, 'alu_medio_contacto');
	}

	public function localidade()
	{
		return $this->belongsTo(Localidade::class, 'loc_id_1');
	}

	public function provincia()
	{
		return $this->belongsTo(Provincia::class, 'prv_id_1');
	}

	public function paise()
	{
		return $this->belongsTo(Paise::class, 'pais_id1');
	}

	public function operaciones()
	{
		return $this->hasMany(Operacione::class, 'alu_id');
	}
}
