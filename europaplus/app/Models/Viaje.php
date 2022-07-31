<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Viaje
 * 
 * @property int $vje_id
 * @property int $vje_vuelo
 * @property int $vje_transfer
 * @property string $vje_descr
 * @property string|null $vje_ida_linea
 * @property Carbon|null $vje_ida_salida
 * @property string|null $vje_ida_hsalida
 * @property Carbon|null $vje_ida_llegada
 * @property string|null $vje_ida_hllegada
 * @property string|null $vje_ida_aeropuerto
 * @property string|null $vje_ida_aeropuerto1
 * @property string|null $vje_ida_num_vuelo
 * @property string|null $vje_ida_num_vuelo1
 * @property string|null $vje_vta_linea
 * @property Carbon|null $vje_vta_salida
 * @property string|null $vje_vta_hsalida
 * @property Carbon|null $vje_vta_llegada
 * @property string|null $vje_vta_hllegada
 * @property string|null $vje_vta_aeropuerto
 * @property string|null $vje_vta_aeropuerto1
 * @property string|null $vje_vta_num_vuelo
 * @property string|null $vje_vta_num_vuelo1
 * @property float $vje_vuelo_precio
 * @property float $vje_transfer_precio
 * @property int $axp_id
 * @property string|null $vje_info_salida
 * @property string|null $vje_info_llegada
 * @property int $vje_vuelo_tipo
 * @property float $vje_vuelo_coste
 * @property int $vje_transfer_tipo
 * @property float $vje_transfer_coste
 * @property int $opr_id
 * @property string|null $vje_ida_localizador
 * @property string|null $vje_vta_localizador
 * 
 * @property Operacione $operacione
 *
 * @package App\Models
 */
class Viaje extends Model
{
	protected $table = 'viajes';
	protected $primaryKey = 'vje_id';
	public $timestamps = false;

	protected $casts = [
		'vje_vuelo' => 'int',
		'vje_transfer' => 'int',
		'vje_vuelo_precio' => 'float',
		'vje_transfer_precio' => 'float',
		'axp_id' => 'int',
		'vje_vuelo_tipo' => 'int',
		'vje_vuelo_coste' => 'float',
		'vje_transfer_tipo' => 'int',
		'vje_transfer_coste' => 'float',
		'opr_id' => 'int'
	];

	protected $dates = [
		'vje_ida_salida',
		'vje_ida_llegada',
		'vje_vta_salida',
		'vje_vta_llegada'
	];

	protected $fillable = [
		'vje_vuelo',
		'vje_transfer',
		'vje_descr',
		'vje_ida_linea',
		'vje_ida_salida',
		'vje_ida_hsalida',
		'vje_ida_llegada',
		'vje_ida_hllegada',
		'vje_ida_aeropuerto',
		'vje_ida_aeropuerto1',
		'vje_ida_num_vuelo',
		'vje_ida_num_vuelo1',
		'vje_vta_linea',
		'vje_vta_salida',
		'vje_vta_hsalida',
		'vje_vta_llegada',
		'vje_vta_hllegada',
		'vje_vta_aeropuerto',
		'vje_vta_aeropuerto1',
		'vje_vta_num_vuelo',
		'vje_vta_num_vuelo1',
		'vje_vuelo_precio',
		'vje_transfer_precio',
		'axp_id',
		'vje_info_salida',
		'vje_info_llegada',
		'vje_vuelo_tipo',
		'vje_vuelo_coste',
		'vje_transfer_tipo',
		'vje_transfer_coste',
		'opr_id',
		'vje_ida_localizador',
		'vje_vta_localizador'
	];

	public function operacione()
	{
		return $this->belongsTo(Operacione::class, 'opr_id');
	}
}
