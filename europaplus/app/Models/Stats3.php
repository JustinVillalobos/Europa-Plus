<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Stats3
 * 
 * @property int $sts_id
 * @property string|null $sts_descr
 * @property float|null $sts_val1
 * @property float|null $sts_percent1
 * @property float|null $sts_val2
 * @property float|null $sts_percent2
 * @property float|null $sts_val3
 * @property float|null $sts_percent3
 * @property float|null $sts_val4
 * @property float|null $sts_percent4
 * @property float|null $sts_val5
 * @property float|null $sts_percent5
 *
 * @package App\Models
 */
class Stats3 extends Model
{
	protected $table = 'stats_3';
	protected $primaryKey = 'sts_id';
	public $timestamps = false;

	protected $casts = [
		'sts_val1' => 'float',
		'sts_percent1' => 'float',
		'sts_val2' => 'float',
		'sts_percent2' => 'float',
		'sts_val3' => 'float',
		'sts_percent3' => 'float',
		'sts_val4' => 'float',
		'sts_percent4' => 'float',
		'sts_val5' => 'float',
		'sts_percent5' => 'float'
	];

	protected $fillable = [
		'sts_descr',
		'sts_val1',
		'sts_percent1',
		'sts_val2',
		'sts_percent2',
		'sts_val3',
		'sts_percent3',
		'sts_val4',
		'sts_percent4',
		'sts_val5',
		'sts_percent5'
	];
}
