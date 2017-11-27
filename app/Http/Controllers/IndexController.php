<?php

namespace App\Http\Controllers;

use App\Mallar;
use App\Slides;
use App\User;
use Illuminate\Http\Request;

class IndexController extends Controller
{
	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function init(){
		$secilmis_id=Mallar::inRandomOrder()->select('id')->take(4)->get()->toArray();
		foreach ( $secilmis_id as $index=>$item ) {
			$mal=Mallar::find($item['id']);
			$secilmis[$index]['id']=$item['id'];
			$secilmis[$index]['ad']=$mal->ad()->get()->first()->toArray()['ad'];
			if($mal->endirim()->first()!==NULL){
				$secilmis[$index]['endirim']=$mal->endirim()->get()->first()->toArray()['faiz'];
			}else{
				$secilmis[$index]['endirim']=0;
			}
			$secilmis[$index]['qiymet']=$mal->qiymet()->get()->first()->toArray()['qiymet'];
			$secilmis[$index]['sekil']=$mal->sekil()->get()->first()->toArray()['name'];
		}


		$ensonelave=Mallar::orderBy('id','desc')->paginate(8);

		$slides=Slides::select('title','mal','img')->get()->toArray();

    	return view('home',compact(['ensonelave','secilmis','slides']));
    }

	public function dahacox() {
		$mallar=Mallar::orderBy('id','desc')->paginate(12);
		$title='Ən son əlavələr';
		return view('mallar',compact(['mallar','title']));
	}


	public function confirm($token){
		$user=User::where('email_token',$token)->first();
		if(!is_null($user)){
			$user->email_confirmed=1;
			$user->email_token='';
			$user->save();
			return redirect(route('home'))->with('confirm',true);
		}
		return redirect(route('home'))->with('confirm',false);
	}

	public function license(){
		echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">
Bu veb səhifə <a target="_blank" href="https://facebook.com/samir.mammadhasanov" rel="nofollow">Samir Məmmədhəsənov</a> tərəfindən hazırlanmışdır.<br><br><b>İstifadə olunub:</b> Laravel Framework,SASS,JQuery,Ajax.<br><br><a href="https://samirmh.me" rel="nofollow" target="_blank">www.samirmh.me</a>';
	}
}
