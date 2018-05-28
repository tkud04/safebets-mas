<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Teams extends Model {

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['id', 'competition_id', 'uid', 'name'];

}
