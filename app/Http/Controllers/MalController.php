<?php

namespace App\Http\Controllers;

use App\MallarAd;
use App\MallarKateqoriya;
use App\MultiKateqoriyaModel;
use function array_combine;
use function array_unique;
use function broadcast;
use function compact;
use function htmlspecialchars;
use Illuminate\Http\Request;
use App\KateqoriyaModel;
use App\Mallar;
use function is_numeric;
use function mb_strtolower;
use function print_r;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use function trim;

class MalController extends Controller
{
	/**
	 * @param $id
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function show($id) {
		$id=trim(htmlspecialchars( mb_strtolower( $id)));

		if(is_numeric( $id)){
			$check=Mallar::where('id','=',$id)->first();
			if($check===NULL){
				throw new NotFoundHttpException();
			}else{
				$mal=Mallar::find($id);

				$mallar['kod']=$mal->select('kod')->where('id','=',$id)->get()->first()->toArray()['kod'];

				$mallar['ad']=$mal->ad()->get()->first()->toArray()['ad'];

				$mallar['endirim']=$mal->endirim()->get()->first();

				$mallar['melumat']=$mal->melumat()->get()->first()->toArray()['melumat'];

				$mallar['olcu']=$mal->olcu()->get()->toArray();
				foreach ($mallar['olcu'] as $index=>$olcu){
					$mallar['olcu'][$index]=$olcu['olcu'];
				}

//				$mallar['reng']=$mal->reng()->get()->toArray();
//				foreach ($mallar['reng'] as $index=>$reng){
//					$mallar['reng'][$index]=$reng['reng'];
//				}

				$mallar['kateqoriya']=$mal->kateqoriya()->get()->first()->toArray()['kateqoriya'];

				if(isset(explode('_',$mallar['kateqoriya'])[1])){
					$kateqoriya=KateqoriyaModel::select('kateqoriya_ad','slug')->where('id','=',explode('_',$mallar['kateqoriya'])[0])->get()->first()->toArray();
					$multikateqoriya=MultiKateqoriyaModel::select('kateqoriya_ad','slug')->where('id','=',explode('_',$mallar['kateqoriya'])[1])->get()->first()->toArray();
				}else{
					$kateqoriya=KateqoriyaModel::select('kateqoriya_ad','slug')->where('id','=',$mallar['kateqoriya'])->get()->first()->toArray();
				}

				if($mallar['endirim']!==NULL){
					$mallar['endirim']=$mallar['endirim']->toArray()['faiz'];
				}else{
					$mallar['endirim']=0;
				}

				$mallar['qiymet']=$mal->qiymet()->get()->first()['qiymet'];

				$mallar['sekil']=$mal->sekil()->get()->toArray();
				foreach ($mallar['sekil'] as $index=>$sekil){
					$mallar['sekil'][$index]=$sekil['name'];
				}

				$mallar['stok']=$mal->stok()->get()->first()['stok'];

				$mallar['xususiyyetler']=$mal->xususiyet()->get()->toArray();
				foreach ($mallar['xususiyyetler'] as $index=>$xususiyyet){
					$mallar['xususiyyetler'][$index]=array();
					$mallar['xususiyyetler'][$index]['xususiyyet']=$xususiyyet['xususiyyetAdi'];
					$mallar['xususiyyetler'][$index]['teyinat']=$xususiyyet['xususiyyet'];
				}
				return view('bax',compact( ['mallar','kateqoriya','multikateqoriya','id']));
			}
		}else{
			throw new NotFoundHttpException();
		}
    }

	public function mallar() {
		$kateqoriyalar=KateqoriyaModel::select('id','kateqoriya_ad','slug','multi')->get()->toArray();
		for ($i=0;$i<count($kateqoriyalar);$i++){
			if($kateqoriyalar[$i]['multi']==1){

				$multi=KateqoriyaModel::find($kateqoriyalar[$i]['id'])->multicategories()->get()->toArray();
				$kateqoriyalar[$i]['multi']=$multi;
				$kateqoriyalar[$i]['mal-id']=MallarKateqoriya::select('fk_mal_id')->where('kateqoriya','like','%'.$kateqoriyalar[$i]['id'].'_%')->take(3)->get()->toArray();

				foreach ($kateqoriyalar[$i]['mal-id'] as $index=>$item ) {
					$kateqoriyalar[$i]['mal-id'][$index]['sekil']=Mallar::find($item['fk_mal_id']*1)->sekil()->get()->first()->toArray()['name'];
					$kateqoriyalar[$i]['mal-id'][$index]['id']=Mallar::find($item['fk_mal_id']*1)->sekil()->get()->first()->toArray()['fk_mal_id'];
				}
			}
		}
		$mallar=Mallar::orderBy('kod','desc')->paginate(12);

		return view('mallar',compact(['kateqoriyalar','multi']),['mallar'=>$mallar]);
    }

	public function axtaris(Request $request) {
		$title=$request['acarsoz'].' üçün axtarış nəticələri';

		if($request['kateqoriya']!='0'){
			$kateqoriya=htmlspecialchars( trim( mb_strtolower($request['kateqoriya'])));
			$acarsoz=htmlspecialchars( trim( mb_strtolower($request->toArray()['acarsoz'])));

			$mallar_id=MallarKateqoriya::select('fk_mal_id')->where('kateqoriya','=',$kateqoriya)->get()->toArray();
			foreach ($mallar_id as $index=>$mal){
				$mallar_id[$index]=$mal['fk_mal_id'];
			}

			$netice_ad=MallarAd::select('fk_mal_id')->where('ad','like','%'.$acarsoz.'%')->whereIn('fk_mal_id',$mallar_id)->get()->toArray();
			$netice_kod=Mallar::select('id')->where('kod','like','%'.$acarsoz.'%')->whereIn('id',$mallar_id)->get()->toArray();

			foreach ( $netice_ad as $index=>$item ) {
				$netice_ad[$index]=$item['fk_mal_id'];
			}
			foreach ( $netice_kod as $index=>$item ) {
				$netice_kod[$index]=$item['id'];
			}

			$netice=array_merge( $netice_ad, $netice_kod);

			$netice=array_unique( $netice);

			$mallar=Mallar::whereIn('id', $netice)->paginate(12);

			return view('mallar',compact('mallar','kateqoriyalar','title'));
		}else{
			$acarsoz=htmlspecialchars( trim( mb_strtolower($request->toArray()['acarsoz'])));
			$netice_ad=MallarAd::where('ad','like','%'.$acarsoz.'%')->select('fk_mal_id')->get()->toArray();
			$netice_kod=Mallar::where('kod','like','%'.$acarsoz.'%')->select('id')->get()->toArray();

			foreach ( $netice_ad as $index=>$item ) {
				$netice_ad[$index]=$item['fk_mal_id'];
			}
			foreach ( $netice_kod as $index=>$item ) {
				$netice_kod[$index]=$item['id'];
			}

			$netice=array_merge( $netice_ad, $netice_kod);

			$netice=array_unique( $netice);

			$mallar=Mallar::whereIn('id', $netice)->paginate(12);

			return view('mallar',compact('mallar','kateqoriyalar','title'));
		}
    }
}
