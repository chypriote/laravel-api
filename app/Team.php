<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
  protected $fillable = ['name', 'slug', 'games_count', 'wins_count'];
}
