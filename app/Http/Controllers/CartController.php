<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Auth;
use Validator;
use App\Models\Product;
use App\Models\Size;
use App\Models\ProductSize;
use App\Models\BillLogin;
use App\Models\BillLoginDetail;
use App\Models\BillNotLogin;
use App\Models\BillNotLoginDetail;
use Cart;

class CartController extends Controller
{
	public function showBill(Request $request){
		if ($request->all()['user_login']==0) {
			$bill_not_login = BillNotLogin::where('code',$request->all()['code_bill'])->first();

			$info_bill['name'] = $bill_not_login['name'];
			$info_bill['phone'] = $bill_not_login['phone'];
			$info_bill['email'] = $bill_not_login['email'];
			$info_bill['address'] = $bill_not_login['address'];
			$info_bill['total'] = $bill_not_login['total'];
			$info_bill['tax'] = $bill_not_login['tax'];
			$info_bill['time'] = $bill_not_login['created_at'];
			$info_bill['code'] = $bill_not_login['code'];

			$cart = Cart::content()->all();
			foreach ($cart as $item) {
				$your_bill['quantity'] = (int)$item->qty;
				$your_bill['size'] = (int)$item->options->size;
				$your_bill['product_name'] = $item->name;
				$your_bill['price'] = $item->price;
				$your_bill['color'] = $item->options->color;

				$all_bill[] = $your_bill;
			}
			
			return view('/shops/billdetail',['info_bill'=>$info_bill,'all_bill'=>$all_bill]);

		} else {
			$bill_login = BillLogin::where('code',$request->all()['code_bill'])->first();

			$info_bill['name'] = $bill_login['name'];
			$info_bill['phone'] = $bill_login['phone'];
			$info_bill['email'] = $bill_login['email'];
			$info_bill['address'] = $bill_login['address'];
			$info_bill['total'] = $bill_login['total'];
			$info_bill['tax'] = $bill_login['tax'];
			$info_bill['time'] = $bill_login['created_at'];
			$info_bill['code'] = $bill_login['code'];

			$cart = Cart::content()->all();
			foreach ($cart as $item) {
				$your_bill['quantity'] = (int)$item->qty;
				$your_bill['size'] = (int)$item->options->size;
				$your_bill['product_name'] = $item->name;
				$your_bill['price'] = (int)$item->price;
				$your_bill['color'] = $item->options->color;
				$your_bill['image'] = $item->options->image;

				$all_bill[] = $your_bill;
			}

			

			return view('/shops/billdetail',['info_bill'=>$info_bill,'all_bill'=>$all_bill]);
		}
	}

	public function payment(Request $request){

		date_default_timezone_set('Asia/Ho_Chi_Minh');

		$validator = Validator::make($request->all(), [
			'name' => 'required|max:20',
			'address' => 'required',
			'email' => 'required|email',
			'phone' => 'required|min:10|max:11',
		]);

		if ($validator->passes()) {
			$cart = Cart::content()->all();

			if (Auth::guard('web')->user()!=null) {
				$login_bills['user_id'] = Auth::guard('web')->user()->id;
				$login_bills['code'] = date("YmdHis");
				$login_bills['name'] = $request->all()['name'];
				$login_bills['email'] = $request->all()['email'];
				$login_bills['address'] = $request->all()['address'];
				$login_bills['phone'] = $request->all()['phone'];
				$login_bills['total'] = (int)Cart::total(0,'','');
				$login_bills['tax'] = (int)Cart::tax(0,'','');

				BillLogin::create($login_bills);

				$login_bill_id = BillLogin::where('code',$login_bills['code'])->first()->id;

				foreach ($cart as $item) {

					$login_bill_detail['bill_id'] = $login_bill_id;
					$login_bill_detail['product_id'] = (int)$item->id;
					$login_bill_detail['quantity'] = (int)$item->qty;
					$login_bill_detail['size_id'] = (int)$item->options->size_id;
					$login_bill_detail['name'] = $item->name;

					BillLoginDetail::create($login_bill_detail);
				}

				return response()->json(['ok'=>'Order success!','code'=>$login_bills['code']]);
			} else {
				$not_login_bills['code'] = date("YmdHis");
				$not_login_bills['name'] = $request->all()['name'];
				$not_login_bills['email'] = $request->all()['email'];
				$not_login_bills['address'] = $request->all()['address'];
				$not_login_bills['phone'] = $request->all()['phone'];
				$not_login_bills['total'] = (int)Cart::total(0,'','');
				$not_login_bills['tax'] = (int)Cart::tax(0,'','');

				BillNotLogin::create($not_login_bills);

				$not_login_bill_id = BillNotLogin::where('code',$not_login_bills['code'])->first()->id;

				foreach ($cart as $item) {

					$not_login_bill_detail['bill_id'] = $not_login_bill_id;
					$not_login_bill_detail['product_id'] = (int)$item->id;
					$not_login_bill_detail['quantity'] = (int)$item->qty;
					$not_login_bill_detail['size_id'] = (int)$item->options->size_id;
					$not_login_bill_detail['name'] = $item->name;

					BillNotLoginDetail::create($not_login_bill_detail);
				}
				return response()->json(['ok'=>'Order success!','code'=>$not_login_bills['code']]);
			}
		}

		return response()->json(['error'=>$validator->errors()->all()]);
	}

	public function checkLogin(){
		if (strlen(Cart::content())!=2) {
			return response()->json(['cart'=>'not empty']);
		} else {
			return response()->json(['ok'=>'empty']);
		}
	}

	public function checkOut(){
		$data['products'] = Cart::content();		
		$data['count'] = Cart::count();
		$data['total'] = Cart::total(0,'',',');
		$data['tax'] = Cart::tax(0,'',',');
		if (Auth::guard('web')->user()!=null) {
			$data['customer_info']['name'] = Auth::guard('web')->user()->name;
			$data['customer_info']['email'] = Auth::guard('web')->user()->email;
			$data['customer_info']['address'] = Auth::guard('web')->user()->address;
			$data['customer_info']['phone'] = Auth::guard('web')->user()->phone;

			foreach ($data['customer_info'] as $key => $value) {
				if (empty($value)) {
					unset($data['customer_info'][$key]);
				}
			}
		}
		return view('/shops/checkout',compact('data'));
	}

	public function checkCart(){
		if (strlen(Cart::content())==2) {
			return response()->json(['error'=>'Please select the product to buy!']);
		}

	}

	public function deleteProduct(Request $request,$id){
		$size_id = $request->all()['size_id'];

		$rows = Cart::search(function($key, $value) use($id,$size_id) {
			return ($key->id == $id)&&($key->options->size_id == $size_id);
		});

		$item = $rows->first();

		Cart::remove($item->rowId);

		return response()->json(['delete'=>'Deleted from cart!','data'=>Cart::content(),'total'=>Cart::total(0,'',','),'tax'=>Cart::tax()]);	
	}

	public function minusOne(Request $request,$id){
		$size_id = $request->all()['size_id'];

		$rows = Cart::search(function($key, $value) use($id,$size_id) {
			return ($key->id == $id)&&($key->options->size_id == $size_id);
		});

		$item = $rows->first();
		$qty = $item->qty - 1;

		if ($qty < 1) {
			Cart::remove($item->rowId);
			return response()->json(['delete'=>'Deleted from cart!','data'=>Cart::content(),'total'=>Cart::total(0,'',','),'tax'=>Cart::tax()]);
		} else {
			Cart::update($item->rowId, $item->qty - 1);
			return response()->json(['success'=>'ok!','data'=>Cart::content(),'total'=>Cart::total(0,'',','),'tax'=>Cart::tax()]);
		}
	}

	public function plusOne(Request $request,$id){
		$size_id = $request->all()['size_id'];

		$sizes = ProductSize::where('product_id',$id)->get();

		$rows = Cart::search(function($key, $value) use($id,$size_id) {
			return ($key->id == $id)&&($key->options->size_id == $size_id);
		});

		$item = $rows->first();
		$qty = $item->qty + 1;

		foreach ($sizes as $size) {
			if ($size['size_id'] == $size_id) {

				$remain_qty = $size['quantity'];
			}
		}

		if ($qty > $remain_qty) {
			return response()->json(['error_qty'=>'Limit in stock!']);
		} else {
			Cart::update($item->rowId, $item->qty + 1);
			return response()->json(['success'=>'ok!','data'=>Cart::content(),'total'=>Cart::total(0,'',','),'tax'=>Cart::tax()]);
		}
	}

	public function add2cart(Request $request,$id)
	{	
		if (!isset($request->all()['size_id'])) {
			return response()->json(['error'=>'Please select size first!']);
		} else {
			$product = Product::where('id',$id)->first();
			$size = Size::where('id',$request->all()['size_id'])->first()->size;
			$size_id = $request->all()['size_id'];
			$quantity = $request->all()['quantity'];
			$color = $request->all()['color'];
			if (strlen(Cart::content())!=2) {
				$rows = Cart::search(function($key, $value) use($id) {
					return $key->id == $id;
				});

				$item = $rows->first();


				if ($item) {
					$sizes = ProductSize::where('product_id',$id)->get();
					foreach ($sizes as $value) {
						if ($value['size_id'] == $size_id) {

							$remain_qty = $value['quantity'];
						}
					}
					if ($item->qty + (int)$quantity > $remain_qty) {
						return response()->json(['error_qty'=>'Limit in stock!']);
					}
					if ($item->options->size != $size) {
						$cartInfo = [
							'id' => $id,
							'name' => $product->name,
							'price' => $product->sale_price,
							'qty' => $quantity,
							'options' => [
								'image' => $product->image,
								'size' => $size,
								'size_id' => $size_id,
								'color' => $color
							],
						];
						Cart::add($cartInfo);
					} else {
						Cart::update($item->rowId, $item->qty + (int)$quantity);
					}

				} else {
					$cartInfo = [
						'id' => $id,
						'name' => $product->name,
						'price' => $product->sale_price,
						'qty' => $quantity,
						'options' => [
							'image' => $product->image,
							'size' => $size,
							'size_id' => $size_id,
							'color' => $color
						],
					];
					Cart::add($cartInfo);
				}
				return response()->json(['success'=>'ok']);
			} else {

				$cartInfo = [
					'id' => $id,
					'name' => $product->name,
					'price' => $product->sale_price,
					'qty' => $request->all()['quantity'],
					'options' => [
						'image' => $product->image,
						'size' => $size,
						'size_id' => $size_id,
						'color' => $color
					],
				];
				Cart::add($cartInfo);

				return response()->json(['success'=>'ok']);
			}
		}

	}

	public function showCart(){
		if (Cart::content()!=null) {
			$data['cart_detail'] = Cart::content();
			$data['total'] = Cart::total(0,'',',');
			$data['tax'] = Cart::tax(0,'',',');
		} else {
			$data = 'empty';
		}

		return response()->json(['data'=>$data]);
	}

	public function delete(){
		if (strlen(Cart::content())!=2) {
			Cart::destroy();
			return response()->json(['success'=>'ok']);
		} else {
			return response()->json(['error'=>'Nothing to delete!']);
		}
	}

	public function find($slug){
		$product = Product::where('slug',$slug)->firstOrFail();
		$images = Product::find($product['id'])->images;
		$brand = Product::find($product['id'])->brand;
		$sizes = Product::find($product['id'])->sizes;
		$data['product'] = $product;
		if (strlen($images)!=2) {
			$data['images'] = $images;
		}
		if (strlen($sizes)!=2) {
			$data['sizes'] = $sizes;
		}
		$data['brand'] = $brand;

		$quantity = ProductSize::where('product_id',$product['id'])->get();

		if (strlen($quantity)!=2) {
			$total_quantity = 0;
			foreach ($quantity as $value) {
				$total_quantity += $value['quantity'];
			}
		} else {
			$data['total_quantity'] = 0;
		}
		$data['total_quantity'] = $total_quantity;

		return view('/shops/detail',compact('data'));
	}

	public function findSize(Request $request,$id){
		$sizes = ProductSize::where('product_id',$request->all()['product_id'])->get();

		foreach ($sizes as $size) {
			if ($size['size_id'] == $id) {
				$data['size_id'] = $size['size_id'];
				$data['quantity'] = $size['quantity'];
				$data['size_code'] = $size['product_size_code'];
			}
		}

		return response()->json(['data'=>$data]);
	}
}
