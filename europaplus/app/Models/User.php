<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 * 
 * @property int $id
 * @property int $group_id
 * @property string $name
 * @property string|null $password
 *
 * @package App\Models
 */
class User extends Model
{
	protected $table = 'users';
	public $timestamps = false;

	protected $casts = [
		'group_id' => 'int'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'group_id',
		'name',
		'password'
	];
}
