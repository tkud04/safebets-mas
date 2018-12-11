<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class TipsData extends Model {

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['id', 'tid', 'confidence', 'likes', 'comments', 'category', 'results', 'status'];

}
