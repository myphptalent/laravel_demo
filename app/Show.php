<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Show extends Model
{
	protected $table = "shows";
    protected $fillable = ['show_name', 'genre', 'imdb_rating', 'lead_actor'];
}
