<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Cart;

class ShopController extends Controller
{
	public function shop(){
		return view('/shops/index');
	}

	public function all(){
		$datas = Product::orderBy('created_at','desc')->paginate(env('PAGES',12));

		return view('/shops/shop',compact('datas'));
	}
}
