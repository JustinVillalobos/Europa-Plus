<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Archivo
 * 
 * @property int $idArchivo
 * @property int $idOperacion
 * @property string $path
 * @property int $tipo_archivo
 * @property int $status
 * @property string $fechaGenerado
 *
 * @package App\Models
 */
class Archivo extends Model
{
	protected $table = 'archivos';
	public $timestamps = false;

	protected $casts = [
		'idOperacion' => 'int',
		'tipo_archivo' => 'int',
		'status' => 'int'
	];

	protected $fillable = [
		'idOperacion',
		'path',
		'tipo_archivo',
		'status',
		'fechaGenerado'
	];
}
