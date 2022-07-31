<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Provincia
 * 
 * @property int $prv_id
 * @property string $prv_descr
 * @property int $pais_id
 * 
 * @property Paise $paise
 * @property Collection|Agencia[] $agencias
 * @property Collection|Alumno[] $alumnos
 * @property Collection|Empresa[] $empresas
 * @property Collection|Escuela[] $escuelas
 * @property Collection|Localidade[] $localidades
 *
 * @package App\Models
 */
class Provincia extends Model
{
	protected $table = 'provincias';
	protected $primaryKey = 'prv_id';
	public $timestamps = false;

	protected $casts = [
		'pais_id' => 'int'
	];

	protected $fillable = [
		'prv_descr',
		'pais_id'
	];

	public function paise()
	{
		return $this->belongsTo(Paise::class, 'pais_id');
	}

	public function agencias()
	{
		return $this->hasMany(Agencia::class, 'prv_id');
	}

	public function alumnos()
	{
		return $this->hasMany(Alumno::class, 'prv_id_1');
	}

	public function empresas()
	{
		return $this->hasMany(Empresa::class, 'prv_id');
	}

	public function escuelas()
	{
		return $this->hasMany(Escuela::class, 'prv_id');
	}

	public function localidades()
	{
		return $this->hasMany(Localidade::class, 'prv_id');
	}
}
