<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
	protected $fillable = ['name', 'teams_count', 'games_count'];

	public function teams()
	{
		return $this->hasMany('App\Team');
	}
}
