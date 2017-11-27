<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MallarAd extends Model
{
	protected $table='mallar-ad';
	protected $fillable=['ad','fk_mal_id'];
	public function mallar(){
		return $this->belongsTo('App\Mallar');
	}
}
