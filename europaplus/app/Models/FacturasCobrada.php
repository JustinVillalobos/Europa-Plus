<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FacturasCobrada
 * 
 * @property int $facc_id
 * @property int $opr_id
 * @property Carbon $register_date
 *
 * @package App\Models
 */
class FacturasCobrada extends Model
{
	protected $table = 'facturas_cobradas';
	protected $primaryKey = 'facc_id';
	public $timestamps = false;

	protected $casts = [
		'opr_id' => 'int'
	];

	protected $dates = [
		'register_date'
	];

	protected $fillable = [
		'opr_id',
		'register_date'
	];
}
