<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Stats2
 * 
 * @property int $sts_id
 * @property string|null $sts_descr
 * @property float|null $sts_val
 * @property float|null $sts_percent
 *
 * @package App\Models
 */
class Stats2 extends Model
{
	protected $table = 'stats_2';
	protected $primaryKey = 'sts_id';
	public $timestamps = false;

	protected $casts = [
		'sts_val' => 'float',
		'sts_percent' => 'float'
	];

	protected $fillable = [
		'sts_descr',
		'sts_val',
		'sts_percent'
	];
}
