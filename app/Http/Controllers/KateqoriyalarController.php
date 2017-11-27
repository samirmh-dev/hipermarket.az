<?php

namespace App\Http\Controllers;

use App\KateqoriyaModel;
use App\Mallar;
use App\MallarAd;
use App\MallarKateqoriya;
use Illuminate\Http\Request;
use function is_string;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class KateqoriyalarController extends Controller
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
			$id=KateqoriyaModel::select('id')->where('slug','=',$id)->get()->first()->toArray()['id'];
			$mallar_id=MallarKateqoriya::select('fk_mal_id')->where('kateqoriya','=',$id)->get()->toArray();
			foreach ( $mallar_id as $index=>$mal ) {
				$mallar_id[$index]=$mal['fk_mal_id'];
			}

			$mallar=Mallar::whereIn('id', $mallar_id)->paginate(12);
			return view('mallar',compact('mallar','kateqoriyalar','title'));
		}
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$categories=KateqoriyaModel::select('id','kateqoriya_ad','slug','multi','created_at','updated_at')->get()->toArray();
		return view('admin.kateqoriyalar',compact('categories'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @echo Response
	 */
	public function store(Request $request)
	{
		$data=$request->toArray();
		$cat=new KateqoriyaModel();
		$cat->kateqoriya_ad=htmlspecialchars(mb_strtolower(trim($data['ad'])));
		$cat->slug=htmlspecialchars(mb_strtolower(trim($data['link'])));
		if($data['multi']=='yes'){
			$cat->multi=1;
		}else{
			$cat->multi=0;
		}
		echo $cat->save();
	}

	public function getToEdit(Request $request){
		$data=$request->toArray();
		$data=KateqoriyaModel::select('id','kateqoriya_ad','slug','multi')->where('id','=',$data['kateqoriya'])->get()->first()->toArray();
		$data['kateqoriya_ad']=ucfirst(mb_strtolower(trim(htmlspecialchars_decode($data['kateqoriya_ad']))));
		echo json_encode($data);
	}

	public function deyisdir(Request $request){
		$data=$request->toArray();

		$stat='2';

		$category=new KateqoriyaModel();

		if(isset($data['ad'])){

			$slug=KateqoriyaModel::where('slug','=', $data['link'])->first();

			if($slug===NULL){
				$category->where('id','=',$data['kateqoriya'])
				         ->update([
					         'kateqoriya_ad'=>htmlspecialchars(mb_strtolower(trim($data['ad']))),
					         'slug'=>htmlspecialchars(mb_strtolower(trim($data['link']))),
				         ]);
				$stat='1';
			}else{
				$stat='0';
				echo $stat;
				die();
			}

		}

		if(isset($data['multi'])){
			if($data['multi']=='yes'){
				$data['multi']=1;
			}else{
				$data['multi']=0;
			}

			$category->where('id','=',$data['kateqoriya'])
			         ->update([
				         'multi'=>htmlspecialchars($data['multi']),
			         ]);
			$stat='1';

		}

		echo $stat;
	}

	public function sil(Request $request){
		$data=$request->toArray();
		echo KateqoriyaModel::find($data['kateqoriya'])->delete();
	}
}
