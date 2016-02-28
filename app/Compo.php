<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compo extends Model
{
	protected $fillable = ['top', 'jungle', 'mid', 'adc', 'support', 'team_id', 'game_id'];
}
