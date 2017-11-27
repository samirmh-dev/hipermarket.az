<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MallarStok extends Model
{
	protected $table='mallar-stok';
	protected $fillable=['reng_stok','olcu_stok','fk_mal_id'];
	public function mallar(){
		return $this->belongsTo('App\Mallar');
	}
}
