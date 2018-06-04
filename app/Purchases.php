<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchases extends Model {

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['id','buyer_id', 'seller_id', 'ticket_id', 'type', 'qty', 'status'];

}
