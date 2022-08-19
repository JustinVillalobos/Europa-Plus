<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CursosEscuela
 * 
 * @property int $cur_id
 * @property int $esc_id
 * 
 * @property Curso $curso
 * @property Escuela $escuela
 *
 * @package App\Models
 */
class CursosEscuela extends Model
{
	protected $table = 'cursos_escuelas';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'cur_id' => 'int',
		'esc_id' => 'int'
	];
	protected $fillable = [
		'cur_id',
		'esc_id'
	];

	public function curso()
	{
		return $this->belongsTo(Curso::class, 'cur_id');
	}

	public function escuela()
	{
		return $this->belongsTo(Escuela::class, 'esc_id');
	}
}
