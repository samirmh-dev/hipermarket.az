<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MallarQiymet extends Model
{
	protected $table='mallar-qiymet';
	protected $fillable=['qiymet','fk_mal_id'];
	public function mallar(){
		return $this->belongsTo('App\Mallar');
	}
}
