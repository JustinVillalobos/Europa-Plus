<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SuplementosEscuela
 * 
 * @property int $sup_id
 * @property int $esc_id
 * 
 * @property Escuela $escuela
 * @property Suplemento $suplemento
 *
 * @package App\Models
 */
class SuplementosEscuela extends Model
{
	protected $table = 'suplementos_escuelas';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'sup_id' => 'int',
		'esc_id' => 'int'
	];
	protected $fillable = [
		'sup_id',
		'esc_id'
	];

	public function escuela()
	{
		return $this->belongsTo(Escuela::class, 'esc_id');
	}

	public function suplemento()
	{
		return $this->belongsTo(Suplemento::class, 'sup_id');
	}
}
