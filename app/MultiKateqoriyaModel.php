<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MultiKateqoriyaModel extends Model
{
    protected $table='multi-kateqoriyalar';

    protected $fillable=[
		'kateqoriya_ad','slug','fk_kateqoriya_id'
	];

	public function multicategories(){
		return $this->belongsTo('App\KateqoriyaModel');
	}
}
