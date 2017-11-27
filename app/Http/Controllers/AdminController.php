<?php

namespace App\Http\Controllers;

use Illuminate\Cache\Events\CacheEvent;
use Illuminate\Http\Request;
use App\Mehsulstok;
use App\User;
use App\Mehsul;
use App\Page;
use App\Category;
use App\MultiCategory;

class AdminController extends Controller
{
	public function index(){
		return view('admin.index');
	}
}
