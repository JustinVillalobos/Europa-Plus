<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Opcione
 * 
 * @property int $opc_id
 * @property int $opc_tipo_id
 * @property string $opc_descr
 * 
 * @property OpcionesTipo $opciones_tipo
 * @property Collection|Alumno[] $alumnos
 * @property Collection|Escuela[] $escuelas
 *
 * @package App\Models
 */
class Opcione extends Model
{
	protected $table = 'opciones';
	protected $primaryKey = 'opc_id';
	public $timestamps = false;

	protected $casts = [
		'opc_tipo_id' => 'int'
	];

	protected $fillable = [
		'opc_tipo_id',
		'opc_descr'
	];

	public function opciones_tipo()
	{
		return $this->belongsTo(OpcionesTipo::class, 'opc_tipo_id');
	}

	public function alumnos()
	{
		return $this->hasMany(Alumno::class, 'alu_medio_contacto');
	}

	public function escuelas()
	{
		return $this->hasMany(Escuela::class, 'idi_id');
	}
}
