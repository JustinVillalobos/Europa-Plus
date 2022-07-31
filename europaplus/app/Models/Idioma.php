<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Idioma
 * 
 * @property int $idi_id
 * @property string $idi_descr
 *
 * @package App\Models
 */
class Idioma extends Model
{
	protected $table = 'idiomas';
	protected $primaryKey = 'idi_id';
	public $timestamps = false;

	protected $fillable = [
		'idi_descr'
	];
}
