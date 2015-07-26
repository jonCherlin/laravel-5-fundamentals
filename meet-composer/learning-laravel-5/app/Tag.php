<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model {

	/**
	 * Get the ariticles associated with the given tag.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */

	public function articles() {

		return $this->belongsToMany('App\Article');

	}

}
