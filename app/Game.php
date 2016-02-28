<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
	protected $fillable = ['week', 'team_1', 'team_2', 'compo_1', 'compo_2', 'ban_1', 'ban2', 'winner'];
}
