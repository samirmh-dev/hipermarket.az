<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MallarEndirim extends Model
{
	protected $table='mallar-endirim';
	protected $fillable=['faiz','fk_mal_id'];
	public function mallar(){
		return $this->belongsTo('App\Mallar');
	}
}
