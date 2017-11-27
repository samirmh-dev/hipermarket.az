<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KateqoriyaModel extends Model
{
    protected $table='kateqoriyalar';

	public function multicategories(){
		return $this->hasMany('App\MultiKateqoriyaModel','fk_kateqoriya_id');
	}

	public static function kateqoriyalarlist() {
		$kateqoriyalar=KateqoriyaModel::select('id','slug','kateqoriya_ad','multi')->get()->toArray();
		foreach ( $kateqoriyalar as $index=>$kateqoriya) {
			if($kateqoriya['multi']){
				$kateqoriyalar[$index]['multi']=KateqoriyaModel::find($kateqoriya['id']*1)->multicategories()->select('id','slug','kateqoriya_ad')->get()->toArray();
			}
		}

		return $kateqoriyalar;
	}
}
