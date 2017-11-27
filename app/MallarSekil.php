<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MallarSekil extends Model
{
	protected $table='mallar-sekil';
	protected $fillable=['name','fk_mal_id'];
	public function mallar(){
		return $this->belongsTo('App\Mallar');
	}
}
