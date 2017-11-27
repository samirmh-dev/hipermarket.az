<?php

namespace App\Http\Controllers;

use App\Slides;
use function htmlspecialchars;
use Illuminate\Http\Request;
use function mb_strtolower;
use Validator;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class SlideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$slides=Slides::all()->toArray();
        return view('admin.slide.index',compact(['slides']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slide.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request->toArray();
        $validate=Validator::make($data,[
			'title'=>'required|string|max:250',
	        'mal'=>'required|numeric',
	        'sekil'=>'required|image|mimes:jpg,png,jpeg,gif'
        ]);

        if($validate->passes()){
			$slide=new Slides();
	        $slide->title=htmlspecialchars( mb_strtolower( trim($data['title'])),ENT_QUOTES);
	        $slide->mal=htmlspecialchars( mb_strtolower( trim($data['mal'])),ENT_QUOTES);

	        $ad=time().rand(0,999).'.'.$data['sekil']->getClientOriginalExtension();

	        $slide->img=htmlspecialchars( mb_strtolower( trim($ad)),ENT_QUOTES);

	        $slide->save();

	        $yuklenecek=public_path('/src/images/slide/');

	        $img= Image::make($data['sekil']->getRealPath());
	        $img->orientate();
	        $img->resize(1440,function ($constraint) {
			        $constraint->upsize();
			        $constraint->aspectRatio();
		        })->fit(1440, 650)->save($yuklenecek.$ad);

			return redirect()->route('slide.index');
        }else{
			return back()->with('errors',$validate->errors())
			             ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
	    $sekiller=Slides::select('img')->where('id','=',$id)->get()->first()->toArray();
	    File::delete(public_path().'/src/images/slide/'.$sekiller['img']);
        Slides::find($id)->delete();
        return back();
    }
}
