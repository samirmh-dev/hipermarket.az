<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MallarKateqoriya extends Model
{
	protected $table='mallar-kateqoriya';
	protected $fillable=['kateqoriya','fk_mal_id'];
	public function mallar(){
		return $this->belongsTo('App\Mallar');
	}
}
