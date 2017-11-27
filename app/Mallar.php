<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mallar extends Model
{
	protected $table='mallar';

	public function ad(){
		return $this->hasOne('App\MallarAd','fk_mal_id');
	}
	public function endirim(){
		return $this->hasOne('App\MallarEndirim','fk_mal_id');
	}
	public function melumat(){
		return $this->hasOne('App\MallarMelumat','fk_mal_id');
	}
	public function olcu(){
		return $this->hasMany('App\MallarOlcu','fk_mal_id');
	}
	public function qiymet(){
		return $this->hasOne('App\MallarQiymet','fk_mal_id');
	}

	public function sekil(){
		return $this->hasMany('App\MallarSekil','fk_mal_id');
	}
	public function stok(){
		return $this->hasOne('App\MallarStok','fk_mal_id');
	}
	public function xususiyet(){
		return $this->hasMany('App\MallarXususiyyet','fk_mal_id');
	}
	public function kateqoriya() {
		return $this->hasOne('App\MallarKateqoriya','fk_mal_id');
	}
}
