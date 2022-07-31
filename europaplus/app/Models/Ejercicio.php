<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Ejercicio
 * 
 * @property int $ejr_id
 * @property string|null $ejr_descr
 *
 * @package App\Models
 */
class Ejercicio extends Model
{
	protected $table = 'ejercicios';
	protected $primaryKey = 'ejr_id';
	public $timestamps = false;

	protected $fillable = [
		'ejr_descr'
	];
}
