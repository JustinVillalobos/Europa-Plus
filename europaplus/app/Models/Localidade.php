<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Localidade
 * 
 * @property int $loc_id
 * @property string $loc_descr
 * @property int $prv_id
 * @property int $pais_id
 * 
 * @property Provincia $provincia
 * @property Paise $paise
 * @property Collection|Agencia[] $agencias
 * @property Collection|Alumno[] $alumnos
 * @property Collection|Empresa[] $empresas
 * @property Collection|Escuela[] $escuelas
 *
 * @package App\Models
 */
class Localidade extends Model
{
	protected $table = 'localidades';
	protected $primaryKey = 'loc_id';
	public $timestamps = false;

	protected $casts = [
		'prv_id' => 'int',
		'pais_id' => 'int'
	];

	protected $fillable = [
		'loc_descr',
		'prv_id',
		'pais_id'
	];

	public function provincia()
	{
		return $this->belongsTo(Provincia::class, 'prv_id');
	}

	public function paise()
	{
		return $this->belongsTo(Paise::class, 'pais_id');
	}

	public function agencias()
	{
		return $this->hasMany(Agencia::class, 'loc_id');
	}

	public function alumnos()
	{
		return $this->hasMany(Alumno::class, 'loc_id_1');
	}

	public function empresas()
	{
		return $this->hasMany(Empresa::class, 'loc_id');
	}

	public function escuelas()
	{
		return $this->hasMany(Escuela::class, 'loc_id');
	}
}
