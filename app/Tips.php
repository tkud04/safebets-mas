<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Tips extends Model {

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['id', 'tid', 'type', 'content'];

}
