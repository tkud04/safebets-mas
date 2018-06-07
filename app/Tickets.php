<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Tickets extends Model {

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['type', 'user_id', 'category', 'total_odds', 'bsite', 'booking_code', 'result'];

}
