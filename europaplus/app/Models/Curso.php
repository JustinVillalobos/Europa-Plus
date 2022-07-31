<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Curso
 * 
 * @property int $cur_id
 * @property int $cur_tipo_curso
 * @property string $cur_nombre
 * @property string|null $cur_descr
 * @property string|null $cur_descr_de
 * @property int $active
 * @property string|null $cur_descr_en
 * 
 * @property Collection|Escuela[] $escuelas
 * @property Collection|Operacione[] $operaciones
 *
 * @package App\Models
 */
class Curso extends Model
{
	protected $table = 'cursos';
	protected $primaryKey = 'cur_id';
	public $timestamps = false;

	protected $casts = [
		'cur_tipo_curso' => 'int',
		'active' => 'int'
	];

	protected $fillable = [
		'cur_tipo_curso',
		'cur_nombre',
		'cur_descr',
		'cur_descr_de',
		'active',
		'cur_descr_en'
	];

	public function escuelas()
	{
		return $this->belongsToMany(Escuela::class, 'cursos_escuelas', 'cur_id', 'esc_id');
	}

	public function operaciones()
	{
		return $this->hasMany(Operacione::class, 'cur_id');
	}
}
