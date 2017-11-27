<?php

namespace App\Http\Controllers;

use App\KateqoriyaModel;
use App\Mallar;
use App\MallarAd;
use App\MallarEndirim;
use App\MallarKateqoriya;
use App\MallarMelumat;
use App\MallarOlcu;
use App\MallarQiymet;
use App\MallarSekil;
use App\MallarStok;
use App\MallarXususiyyet;
use App\MultiKateqoriyaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Validator;

class MallarController extends Controller
{
	/**
	 * Display a listing of the resource.
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function index()
	{
		$infomal=Mallar::select('id','kod','created_at')->orderBy( 'id','desc')->get()->toArray();
		foreach($infomal as $index=>$mal){
			$infomal[$index]['ad']=Mallar::find($mal['id'])->ad()->select('ad')->get()->first()->toArray()['ad'];
			$infomal[$index]['qiymet']=Mallar::find($mal['id'])->qiymet()->select('qiymet')->get()->first()->toArray()['qiymet'];
			$infomal[$index]['endirim']=Mallar::find($mal['id'])->endirim()->select('faiz')->get()->first();
			$infomal[$index]['stok']=Mallar::find($mal['id'])->stok()->select('stok')->get()->first()['stok'];
			if($infomal[$index]['endirim']===NULL){
				$infomal[$index]['endirim']='NO';
			}else{
				$infomal[$index]['endirim']=$infomal[$index]['endirim']->toArray()['faiz'].'%';
			}
			$infomal[$index]['melumat']=substr(Mallar::find($mal['id'])->melumat()->select('melumat')->get()->first()->toArray()['melumat'],0,25);
		}
		return view('admin.mallar.mallar',compact('infomal'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function create()
	{
		$kateqoriyalar=KateqoriyaModel::select('id','kateqoriya_ad','multi')->get()->toArray();
		foreach ( $kateqoriyalar as $index=>$kateqoriya ) {
			if($kateqoriya['multi']*1){
				$kateqoriyalar[$index]['multi']=KateqoriyaModel::find($kateqoriya['id'])->multicategories()->select('id','kateqoriya_ad','fk_kateqoriya_id')->get()->toArray();
			}
		}
		return view('admin.mallar.create',compact('kateqoriyalar'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 *
	 * @return \Redirect
	 */
	public function store(Request $request)
	{
		$data=$request->toArray();

		$rules=[
			'kod' => 'required|string|unique:mallar',
			'ad' => 'required|string|max:150',
			'melumat' => 'required|string',
			'qiymet' => 'required|numeric',
			'olculer' => 'required|string',
			'kateqoriya'=>'required|string',
			'xususiyyet.*'=>'string|max:20',
			'teyinat.*'=>'string|max:20',
			'sekil.*'=>'image|mimes:jpg,jpeg,png',
			'sekil.0'=>'required|image|mimes:jpg,jpeg,png'
		];
		$check=Validator::make($data,$rules);

		if ($check->fails()) {
			return redirect(route('mallar.elaveet-form'))
				->with('errors',$check->errors())
				->withInput();
		}else{
			try{
				//Mal
				$elave=new Mallar();
				$elave->kod=trim(mb_strtolower(htmlspecialchars($data['kod'],ENT_QUOTES)));
				$elave->save();

				$mal=Mallar::select('id')->where('kod','=',trim(mb_strtolower(htmlspecialchars($data['kod'],ENT_QUOTES))))->get()->first();
				$mal=Mallar::find($mal['id']);

				//Ad
				$ad=new MallarAd([
					'ad'=>trim(mb_strtolower(htmlspecialchars($data['ad'],ENT_QUOTES))),
				]);
				$mal->ad()->save($ad);

				$kateqoriya=new MallarKateqoriya([
					'kateqoriya'=>$data['kateqoriya']
				]);
				$mal->kateqoriya()->save($kateqoriya);

				//Melumat
				$melumat=new MallarMelumat([
					'melumat'=>trim(htmlspecialchars($data['melumat'],ENT_QUOTES)),
				]);
				$mal->melumat()->save($melumat);

				//Olcu
				$data['olculer']=explode(',',$data['olculer']);
				foreach ($data['olculer'] as $olcu){
					$malOlcu=new MallarOlcu([
						'olcu'=>trim(mb_strtolower(htmlspecialchars($olcu,ENT_QUOTES)))
					]);
					$mal->olcu()->save($malOlcu);
				}


				//Qiymet
				$qiymet=new MallarQiymet([
					'qiymet'=>trim(mb_strtolower(htmlspecialchars($data['qiymet'],ENT_QUOTES)))
				]);
				$mal->qiymet()->save($qiymet);

				//Xususiyyet
				if(isset($data['xususiyyet'])){
					foreach ($data['xususiyyet'] as $index=>$xususiyyet){
						$xususiyyetMal=new MallarXususiyyet([
							'xususiyyetAdi'=>trim(mb_strtolower(htmlspecialchars($xususiyyet,ENT_QUOTES))),
							'xususiyyet'=>trim(mb_strtolower(htmlspecialchars($data['teyinat'][$index],ENT_QUOTES))),
						]);
						$mal->xususiyet()->save($xususiyyetMal);
					}
				}

				//Stok
				$stok=new MallarStok([
					'stok'=>1
				]);
				$mal->stok()->save($stok);

				// Images
				foreach ($data['sekil'] as $index=>$sekil){

					$ad=time().rand(0,999).'.'.$data['sekil'][$index]->getClientOriginalExtension();
					$yuklenecek=public_path('/src/images/stock/');
					$yuklenecekProductThumb=public_path('/src/images/60x79/');
					$yuklenecekProductImage=public_path('/src/images/190x250/');
					$yuklenecekStoreImage=public_path('/src/images/500x659/');

					$img= Image::make($data['sekil'][$index]->getRealPath());
					$img->orientate();
					$img->resize(60, 79,
						function ($constraint) {
							$constraint->upsize();
							$constraint->aspectRatio();
						})->save($yuklenecekProductThumb.$ad);

					$img= Image::make($data['sekil'][$index]->getRealPath());
					$img->orientate();
					$img->resize(190, 250,
						function ($constraint) {
							$constraint->upsize();
							$constraint->aspectRatio();
						})->save($yuklenecekProductImage.$ad);

					$img= Image::make($data['sekil'][$index]->getRealPath());
					$img->orientate();
					$img->resize(350, 425,
						function ($constraint) {
							$constraint->upsize();
							$constraint->aspectRatio();
						})->save($yuklenecekStoreImage.$ad);

					$data['sekil'][$index]->move($yuklenecek,$ad);

					$db=new MallarSekil([
						'name'=>trim(mb_strtolower(htmlspecialchars($ad,ENT_QUOTES))),
					]);
					$mal->sekil()->save($db);
				}
				return redirect(route('mallar.index'));

			}catch(\Exception $e){
				return redirect(route('mallar.elaveet-form'))->with('status',$e->getMessage())->withInput();
			}
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function show($id)
	{
		$id=trim(mb_strtolower(htmlspecialchars($id,ENT_QUOTES)))*1;
		$mal=Mallar::find($id);

		$kod=Mallar::select('kod')->where('id','=',$id)->get()->first()->toArray();

		$ad=$mal->ad()->select('ad')->get()->first()->toArray();

		$melumat=$mal->melumat()->select('melumat')->get()->first()->toArray();

		$qiymet=$mal->qiymet()->select('qiymet')->get()->first()->toArray();

		$olculer=$mal->olcu()->select('olcu')->get()->toArray();

		foreach($olculer as $index=>$olcu){
			$olculerNew['olculer'][]=$olcu['olcu'];
		}
		unset($olculer);


		$xususiyyetler=$mal->xususiyet()->select('xususiyyetAdi','xususiyyet')->get()->toArray();

		foreach($xususiyyetler as $index=>$xususiyyet){
			$xususiyyetNew['xususiyyetler'][$index]['xususiyyet']=$xususiyyet['xususiyyetAdi'];
			$xususiyyetNew['xususiyyetler'][$index]['teyinat']=$xususiyyet['xususiyyet'];
		}
		unset($xususiyyetler);

		$sekiller=$mal->sekil()->select('name')->get()->toArray();
		foreach($sekiller as $index=>$sekil){
			$sekilNew['sekiller'][]=$sekil['name'];
		}
		unset($sekiller);

		$endirim=$mal->endirim()->select('faiz')->get()->first();
		if($endirim!==NULL){
			$endirim=$endirim->toArray();
		}

		if(empty($endirim)){
			$endirim['endirim']='NO';
		}else{
			$endirim['endirim']=$endirim['faiz'];
		}

		$stok=$mal->stok()->select('stok')->get()->first()->toArray();
		if($stok['stok']*1){
			$stok['stok']='Yes';
		}else{
			$stok['stok']='No';
		}

		$kateqoriya=$mal->kateqoriya()->select('kateqoriya')->get()->first()->toArray();

		if(isset($xususiyyetNew)){
			$content=array_merge($kod,$ad,$melumat,$qiymet,$olculerNew,$xususiyyetNew,$sekilNew,$endirim,$stok,$kateqoriya);
		}else{
			$content=array_merge($kod,$ad,$melumat,$qiymet,$olculerNew,$sekilNew,$endirim,$stok,$kateqoriya);
		}


		$kateqoriyalar=KateqoriyaModel::select('id','kateqoriya_ad')->get()->toArray();
		$multikateqoriyalar=MultiKateqoriyaModel::select('id','kateqoriya_ad','fk_kateqoriya_id')->get()->toArray();

		return view('admin.mallar.show',compact('content','id','kateqoriyalar','multikateqoriyalar'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function edit($id)
	{
		$id=trim(mb_strtolower(htmlspecialchars($id,ENT_QUOTES)))*1;
		$mal=Mallar::find($id);

		$kod=Mallar::select('kod')->where('id','=',$id)->get()->first()->toArray();

		$ad=$mal->ad()->select('ad')->get()->first()->toArray();

		$melumat=$mal->melumat()->select('melumat')->get()->first()->toArray();

		$qiymet=$mal->qiymet()->select('qiymet')->get()->first()->toArray();

		$olculer=$mal->olcu()->select('olcu')->get()->toArray();

		$kateqoriyamal=$mal->kateqoriya()->select('kateqoriya')->get()->first()->toArray();


		$kateqoriyalar=KateqoriyaModel::select('id','kateqoriya_ad','multi')->get()->toArray();
		foreach ( $kateqoriyalar as $index=>$kateqoriya ) {
			if($kateqoriya['multi']*1){
				$kateqoriyalar[$index]['multi']=KateqoriyaModel::find($kateqoriya['id'])->multicategories()->select('id','kateqoriya_ad','fk_kateqoriya_id')->get()->toArray();
			}
		}

		foreach($olculer as $index=>$olcu){
			$olculerNew['olculer'][]=$olcu['olcu'];
		}
		unset($olculer);

		$xususiyyetler=$mal->xususiyet()->select('xususiyyetAdi','xususiyyet')->get()->toArray();
		foreach($xususiyyetler as $index=>$xususiyyet){
			$xususiyyetNew['xususiyyetler'][$index]['xususiyyet']=$xususiyyet['xususiyyetAdi'];
			$xususiyyetNew['xususiyyetler'][$index]['teyinat']=$xususiyyet['xususiyyet'];
		}
		unset($xususiyyetler);

		$sekiller=$mal->sekil()->select('name')->get()->toArray();
		foreach($sekiller as $index=>$sekil){
			$sekilNew['sekiller'][]=$sekil['name'];
		}
		unset($sekiller);

		$endirim=$mal->endirim()->select('faiz')->get()->first();
		if($endirim!==NULL){
			$endirim=$endirim->toArray();
		}

		if(empty($endirim)){
			$endirim['endirim']='NO';
		}else{
			$endirim['endirim']=$endirim['faiz'];
		}

		$stok=$mal->stok()->select('stok')->get()->first()->toArray();
		if($stok['stok']*1){
			$stok['stok']='Yes';
		}else{
			$stok['stok']='No';
		}


		if(isset($xususiyyetNew)){
			$content=array_merge($kod,$ad,$melumat,$qiymet,$olculerNew,$xususiyyetNew,$sekilNew,$endirim,$stok,$kateqoriyamal);
		}else{
			$content=array_merge($kod,$ad,$melumat,$qiymet,$olculerNew,$sekilNew,$endirim,$stok,$kateqoriyamal);
		}
		return view('admin.mallar.edit',compact('content','id','kateqoriyalar'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function update($id,Request $request)
	{
		$data=$request->toArray();
		$rules=[
			'kodstandart'=>'required|string',
			'kod'=>'required|string',
			'ad' => 'required|string|max:150',
			'melumat' => 'required|string',
			'qiymet' => 'required|numeric',
			'olculer' => 'required|string',
			'kateqoriya' => 'required|string',
			'xususiyyet.*'=>'string|max:20',
			'teyinat.*'=>'string|max:20',
			'endirim'=>'required|numeric|max:100',
			'silineceksekil'=>'array',
			'silineceksekil.*'=>'string',
			'stok'=>'boolean',
			'sekil.*'=>'image|mimes:jpg,jpeg,png',
		];
		$validation=Validator::make($data,$rules);

		if($validation->passes()){
			$mal=Mallar::find($id);
			try{
				if($data['kodstandart']!=$data['kod']) {
					Mallar::where('id','=',$id)->update([
						'kod'=>$data['kod']
					]);
				}

				$mal->ad()->update([
					'ad'=>trim( htmlspecialchars( mb_strtolower( $data['ad']),ENT_QUOTES))
				]);

				$mal->melumat()->update([
					'melumat'=>trim( htmlspecialchars(  $data['melumat'],ENT_QUOTES))
				]);

				$mal->qiymet()->update([
					'qiymet'=>$data['qiymet']
				]);

				$mal->kateqoriya()->update( [
					'kateqoriya'=>$data['kateqoriya']
				]);

				$mal->olcu()->delete();
				$olculer=explode(',',$data['olculer']);
				foreach ( $olculer as $olcu ) {
					$olcuDb=new MallarOlcu([
						'olcu'=>trim( mb_strtolower( htmlspecialchars( $olcu,ENT_QUOTES)))
					]);
					$mal->olcu()->save($olcuDb);
				}

//				$mal->reng()->delete();
//				foreach ($data['sekilreng'] as $index=>$reng){
//					$rengDb=new MallarReng([
//						'reng'=>trim( mb_strtolower( htmlspecialchars( $reng,ENT_QUOTES))),
//						'image'=>trim( mb_strtolower( htmlspecialchars( $index,ENT_QUOTES)))
//					]);
//					$mal->reng()->save($rengDb);
//				}

				if(isset($data['xususiyyet'])){
					$mal->xususiyet()->delete();
					foreach ( $data['xususiyyet'] as $index=>$xususiyyet ) {
						$new= new MallarXususiyyet([
							'xususiyyetAdi'=>trim( mb_strtolower( htmlspecialchars( $xususiyyet,ENT_QUOTES))),
							'xususiyyet'=>trim( mb_strtolower( htmlspecialchars( $data['teyinat'][$index],ENT_QUOTES)))
						]);
						$mal->xususiyet()->save($new);
					}
				}else{
					$mal->xususiyet()->delete();
				}

				if($data['endirim']=='0'){
					$mal->endirim()->delete();
				}
				if($data['endirim']!='0'){
					$mal->endirim()->delete();
					$new=new MallarEndirim([
						'faiz'=>$data['endirim']
					]);
					$mal->endirim()->save($new);
				}
				if(isset($data['stok'])){
					if($data['stok']==1){
						$mal->stok()->update([
							'stok'=>1
						]);
					}
				}else{
					$mal->stok()->update([
						'stok'=>0
					]);
				}

				try{
					if(isset($data['silineceksekil'])){
						foreach ($data['silineceksekil'] as $silinecek){
							$mal->sekil()->where('name','=',base64_decode( $silinecek))->delete();
							$x60[]=public_path().'/src/images/60x79/'.base64_decode( $silinecek);
							$x190[]=public_path().'/src/images/190x250/'.base64_decode( $silinecek);
							$x500[]=public_path().'/src/images/500x659/'.base64_decode( $silinecek);
							$stock[]=public_path().'/src/images/stock/'.base64_decode( $silinecek);
							File::delete($x60);
							File::delete($x190);
							File::delete($x500);
							File::delete($stock);
						}
					}

					if(isset($data['sekil'])){
						foreach ($data['sekil'] as $index=>$sekil){

							$ad=time().rand(0,999).'.'.$data['sekil'][$index]->getClientOriginalExtension();
							$yuklenecek=public_path('/src/images/stock/');
							$yuklenecekProductThumb=public_path('/src/images/60x79/');
							$yuklenecekProductImage=public_path('/src/images/190x250/');
							$yuklenecekStoreImage=public_path('/src/images/500x659/');

							$img= Image::make($data['sekil'][$index]->getRealPath());
							$img->orientate();
							$img->resize(60, 79,
								function ($constraint) {
									$constraint->upsize();
									$constraint->aspectRatio();
								})->save($yuklenecekProductThumb.$ad);

							$img= Image::make($data['sekil'][$index]->getRealPath());
							$img->orientate();
							$img->resize(190, 250,
								function ($constraint) {
									$constraint->upsize();
									$constraint->aspectRatio();
								})->save($yuklenecekProductImage.$ad);

							$img= Image::make($data['sekil'][$index]->getRealPath());
							$img->orientate();
							$img->resize(350, 425,
								function ($constraint) {
									$constraint->upsize();
									$constraint->aspectRatio();
								})->save($yuklenecekStoreImage.$ad);

							$data['sekil'][$index]->move($yuklenecek,$ad);

							$db=new MallarSekil([
								'name'=>trim(mb_strtolower(htmlspecialchars($ad,ENT_QUOTES))),
							]);
							$mal->sekil()->save($db);
						}
					}
				}catch (\Exception $f){
					return back()->with('status',$f->getMessage())->withInput();
				}
			}catch(\Exception $e){
				return back()->with('status',$e->getMessage())->withInput();
			}
			return redirect(route('mallar.index'));
		}else{
			return back()
				->with('errors',$validation->errors())
				->withInput();
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Redirect
	 */
	public function destroy($id)
	{
		if(is_int($id*1)){
			$sekiller=Mallar::find($id*1)->sekil()->select('name')->get()->toArray();
			foreach($sekiller as $index=>$name){
				$x60[]=public_path().'/src/images/60x79/'.$name['name'];
				$x190[]=public_path().'/src/images/190x250/'.$name['name'];
				$x500[]=public_path().'/src/images/500x659/'.$name['name'];
				$stock[]=public_path().'/src/images/stock/'.$name['name'];
			}
			File::delete($x60);
			File::delete($x190);
			File::delete($x500);
			File::delete($stock);
			$mal=Mallar::where('id','=',$id*1)->delete();
			return redirect(route('mallar.index'));
		}else{
			return redirect(route('mallar.index'));
		}
	}
}
