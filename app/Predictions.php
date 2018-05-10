<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Predictions extends Model {

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['ticket_id', 'fixture_id', 'prediction', 'outcome'];

}