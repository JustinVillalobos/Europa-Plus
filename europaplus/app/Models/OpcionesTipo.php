<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class OpcionesTipo
 * 
 * @property int $opc_tipo_id
 * @property string $opc_tipo_descr
 * 
 * @property Collection|Opcione[] $opciones
 *
 * @package App\Models
 */
class OpcionesTipo extends Model
{
	protected $table = 'opciones_tipos';
	protected $primaryKey = 'opc_tipo_id';
	public $timestamps = false;

	protected $fillable = [
		'opc_tipo_descr'
	];

	public function opciones()
	{
		return $this->hasMany(Opcione::class, 'opc_tipo_id');
	}
}
