<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ban extends Model
{
	protected $fillable = ['ban_1', 'ban_2', 'ban_3', 'team_id', 'game_id'];
}
