<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MallarXususiyyet extends Model
{
	protected $table='mallar-xususiyyet';
	protected $fillable=['xususiyyetAdi','xususiyyet','fk_mal_id'];
	public function mallar(){
		return $this->belongsTo('App\Mallar');
	}
}
