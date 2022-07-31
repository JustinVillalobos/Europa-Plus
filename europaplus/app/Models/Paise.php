<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Paise
 * 
 * @property int $pais_id
 * @property string $pais_descr
 * 
 * @property Collection|Agencia[] $agencias
 * @property Collection|Alumno[] $alumnos
 * @property Collection|Empresa[] $empresas
 * @property Collection|Escuela[] $escuelas
 * @property Collection|Localidade[] $localidades
 * @property Collection|Provincia[] $provincias
 *
 * @package App\Models
 */
class Paise extends Model
{
	protected $table = 'paises';
	protected $primaryKey = 'pais_id';
	public $timestamps = false;

	protected $fillable = [
		'pais_descr'
	];

	public function agencias()
	{
		return $this->hasMany(Agencia::class, 'pais_id');
	}

	public function alumnos()
	{
		return $this->hasMany(Alumno::class, 'pais_id1');
	}

	public function empresas()
	{
		return $this->hasMany(Empresa::class, 'pais_id');
	}

	public function escuelas()
	{
		return $this->hasMany(Escuela::class, 'pais_id');
	}

	public function localidades()
	{
		return $this->hasMany(Localidade::class, 'pais_id');
	}

	public function provincias()
	{
		return $this->hasMany(Provincia::class, 'pais_id');
	}
}
