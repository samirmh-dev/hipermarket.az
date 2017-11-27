<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MallarOlcu extends Model
{
	protected $table='mallar-olcu';
	protected $fillable=['olcu','fk_mal_id'];
	public function mallar(){
		return $this->belongsTo('App\Mallar');
	}
}
