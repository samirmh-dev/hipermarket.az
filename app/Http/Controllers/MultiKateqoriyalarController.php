<?php

namespace App\Http\Controllers;

use App\KateqoriyaModel;
use App\Mallar;
use App\MallarKateqoriya;
use App\MultiKateqoriyaModel;
use Illuminate\Http\Request;
use function is_numeric;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class MultiKateqoriyalarController extends Controller
{
	public function goster($id) {
		if(is_numeric($id)){
			throw new NotFoundHttpException();
		}else{
//			$kateqoriyalar=KateqoriyaModel::select('id','kateqoriya_ad','slug','multi')->get()->toArray();
//			for ($i=0;$i<count($kateqoriyalar);$i++){
//				if($kateqoriyalar[$i]['multi']==1){
//
//					$multi=KateqoriyaModel::find($kateqoriyalar[$i]['id'])->multicategories()->get()->toArray();
//					$kateqoriyalar[$i]['multi']=$multi;
//					$kateqoriyalar[$i]['mal-id']=MallarKateqoriya::select('fk_mal_id')->where('kateqoriya','like','%'.$kateqoriyalar[$i]['id'].'_%')->take(3)->get()->toArray();
//
//					foreach ($kateqoriyalar[$i]['mal-id'] as $index=>$item ) {
//						$kateqoriyalar[$i]['mal-id'][$index]['sekil']=Mallar::find($item['fk_mal_id']*1)->sekil()->get()->first()->toArray()['name'];
//						$kateqoriyalar[$i]['mal-id'][$index]['id']=Mallar::find($item['fk_mal_id']*1)->sekil()->get()->first()->toArray()['fk_mal_id'];
//					}
//				}
//			}

			$title=env('APP_NAME');


			$id=MultiKateqoriyaModel::select('id','fk_kateqoriya_id')->where('slug','=',$id)->get()->first()->toArray();
			$mallar_id=MallarKateqoriya::select('fk_mal_id')->where('kateqoriya','=',$id['fk_kateqoriya_id'].'_'.$id['id'])->get()->toArray();
			$mallar=Mallar::whereIn('id', $mallar_id)->paginate(12);

			return view('mallar',compact('mallar','kateqoriyalar','title'));
		}
	}

	public function index(){
		$categories=KateqoriyaModel::select('id','kateqoriya_ad')->where('multi','=',1)->get()->toArray();
		foreach ($categories as $index=>$category){
			$categories[$index]['multi']=KateqoriyaModel::find($category['id'])->multicategories()->get()->toArray();
		}

		$butunKateqoriyalar=KateqoriyaModel::select('id','kateqoriya_ad')->where('multi','=',1)->get()->toArray();
		return view('admin.multiKateqoriya',compact('categories','butunKateqoriyalar'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @echo Response
	 */
	public function store(Request $request)
	{
		$data=$request->toArray();
		$checkSlug=MultiKateqoriyaModel::where([
			['slug','=', $data['link']],
			['fk_kateqoriya_id','=',$data['kateqoriya']]
		])->first();

		if($checkSlug===NULL) {
			$newMultiCat = new MultiKateqoriyaModel([
				'kateqoriya_ad'=>$data['ad'],
				'slug'=>$data['link'],
			]);

			$kateqoriya=KateqoriyaModel::find($data['kateqoriya']*1);

			$kateqoriya->multicategories()->save($newMultiCat);
			echo '1';
			die();
		}else{
			echo '0';
		}
	}
	public function getToEdit(Request $request){
		$data=$request->toArray();
		$id=explode('_',$data['kateqoriya'])[1];
		$data=MultiKateqoriyaModel::select('id','kateqoriya_ad','slug')->where('id','=',$id)->get()->first()->toArray();
		echo json_encode($data);
	}
	public function deyisdir(Request $request){
		$data=$request->toArray();

		$stat='2';

		if(isset($data['ad'])){

			$check = MultiKateqoriyaModel::where('slug','=',$data['link'])->first();

			if($check===NULL){
				MultiKateqoriyaModel::where('id','=',$data['kateqoriya'])
				             ->update([
					             'kateqoriya_ad'=>mb_strtolower(trim(htmlspecialchars($data['ad']))),
					             'slug'=>mb_strtolower(trim(htmlspecialchars($data['link']))),
				             ]);
				$stat='1';
			}else{
				$stat='0';
				echo $stat;
				die();
			}
		}

		if(isset($data['katedit'])){
			$check=MultiKateqoriyaModel::select('slug')->where('fk_kateqoriya_id','=',$data['katedit'])->get()->toArray();

			$currentSlug=MultiKateqoriyaModel::select('slug')
			                          ->where('id','=',$data['kateqoriya'])->first()->toArray();

			foreach ($check as $item){
				if($currentSlug['slug']==$item['slug']){
					$stat='0';
					echo $stat;
					die();
				}
			}

			MultiKateqoriyaModel::where('id','=',$data['kateqoriya'])
			             ->update([
				             'fk_kateqoriya_id'=>$data['katedit'],
			             ]);
			$stat='1';
		}
		echo $stat;
	}
	public function sil(Request $request){
		$data=$request->toArray();
		$kateqoriya=explode('_',$data['kateqoriya'])[1];
		echo MultiKateqoriyaModel::where('id','=',$kateqoriya)->delete();
	}
}
