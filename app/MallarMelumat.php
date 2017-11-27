<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MallarMelumat extends Model
{
	protected $table='mallar-melumat';
	protected $fillable=['melumat','fk_mal_id'];
	public function mallar(){
		return $this->belongsTo('App\Mallar');
	}
}
