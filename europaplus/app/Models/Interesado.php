<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Interesado
 * 
 * @property int $int_id
 * @property string|null $int_nombre
 * @property string|null $int_apellidos
 * @property int|null $int_edad
 * @property int|null $int_sexo
 * @property string|null $int_profesion
 * @property string|null $int_email
 * @property string|null $int_telefono
 * @property string|null $int_movil
 * @property string|null $int_direccion
 * @property int|null $loc_id
 * @property int|null $prv_id
 * @property int|null $pais_id
 * @property string|null $int_cp
 * @property int|null $int_tipo_curso
 * @property int|null $int_idioma
 * @property int|null $int_loc_id
 * @property int|null $int_year
 *
 * @package App\Models
 */
class Interesado extends Model
{
	protected $table = 'interesados';
	protected $primaryKey = 'int_id';
	public $timestamps = false;

	protected $casts = [
		'int_edad' => 'int',
		'int_sexo' => 'int',
		'loc_id' => 'int',
		'prv_id' => 'int',
		'pais_id' => 'int',
		'int_tipo_curso' => 'int',
		'int_idioma' => 'int',
		'int_loc_id' => 'int',
		'int_year' => 'int'
	];

	protected $fillable = [
		'int_nombre',
		'int_apellidos',
		'int_edad',
		'int_sexo',
		'int_profesion',
		'int_email',
		'int_telefono',
		'int_movil',
		'int_direccion',
		'loc_id',
		'prv_id',
		'pais_id',
		'int_cp',
		'int_tipo_curso',
		'int_idioma',
		'int_loc_id',
		'int_year'
	];
}
