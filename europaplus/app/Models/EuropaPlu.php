<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EuropaPlu
 * 
 * @property int $idEmpresa
 * @property string $nombre
 * @property string $direccion
 * @property string $correo
 * @property string $sitio_web
 * @property string $telefono
 * @property string $whatsapp
 * @property string $codigo_postal
 * @property string $banco
 * @property string $direccion_banco
 * @property string $IBAN
 * @property string $SWIFT
 *
 * @package App\Models
 */
class EuropaPlu extends Model
{
	protected $table = 'europa_plus';
	protected $primaryKey = 'idEmpresa';
	public $timestamps = false;

	protected $fillable = [
		'nombre',
		'direccion',
		'correo',
		'sitio_web',
		'telefono',
		'whatsapp',
		'codigo_postal',
		'banco',
		'direccion_banco',
		'IBAN',
		'SWIFT'
	];
}
