<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Brand;
use App\Models\Product;
use Yajra\Datatables\Datatables;

class BrandsController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin.auth');
    }

    public function delete($id){
    	$check = Brand::find($id)->products;
    	if (strlen($check)!=2) {
    		return response()->json(['error'=>'This brand already had products!']);
    	} else {
    		Brand::where('id',$id)->delete();
    		return response()->json(['success'=>'ok']);
    	}
    }

    public function update(Request $request, $id){
    	date_default_timezone_set('Asia/Ho_Chi_Minh');
		$validator = Validator::make($request->all(), [
			'name' => 'required',
			'thumbnail' => 'max:2500|mimes:jpg,jpeg,webp,png',
        ]);
		$data_request = $request->all();
		
        if ($validator->passes()) {
        	$data_request['slug'] = str_slug($data_request['name']);
        	$result = Brand::where('slug',$data_request['slug'])->first();
        	if ($result) {
        		if ($result['id']!=$id) {
        			return response()->json(['error_slug'=>'Slug must unique!']);
        		}
        	}
        	if ($request->thumbnail) {
        		$original_name = $data_request['thumbnail']->getClientOriginalName();
        	
        		$data_request['thumbnail'] = $data_request['thumbnail']->storeAs('/img_brand',$original_name,'public');
        	} else {
        		unset($data_request['thumbnail']);
        	}

        	Brand::where('id',$id)->update($data_request);

        	return response()->json(['success'=>'ok']);
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }

    public function find($id){
    	$result = Brand::where('id',$id)->firstOrFail();

    	return response()->json(['data'=>$result]);
    }

    public function store(Request $request){
    	date_default_timezone_set('Asia/Ho_Chi_Minh');
		$validator = Validator::make($request->all(), [
			'name' => 'required',
			'thumbnail' => 'max:2500|mimes:jpg,jpeg,webp,png',
        ]);
		$data_request = $request->all();
		
        if ($validator->passes()) {
        	$data_request['slug'] = str_slug($data_request['name']);
        	$result = Brand::where('slug',$request['slug'])->first();
        	if ($result) {
        		return response()->json(['error_slug'=>'Slug must unique!']);
        	}
        	if ($request->thumbnail) {
        		$original_name = $data_request['thumbnail']->getClientOriginalName();
        	
        		$data_request['thumbnail'] = $data_request['thumbnail']->storeAs('/img_brand',$original_name,'public');
        	} else {
        		unset($data_request['thumbnail']);
        	}

        	Brand::create($data_request);

        	return response()->json(['success'=>'ok']);
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }

    public function formBrand(){
        return view('admin/brands/brand');
    }

    public function getBrand(){
        $brands = Brand::orderBy('id','desc');
        
        return Datatables::of($brands)
        ->editColumn('thumbnail', function($brand) {
            if ($brand->thumbnail) {
                return '<img class="image-product" src='.asset('storage').'/'.$brand->thumbnail.'>';
            } else {
                return '<img class="image-product" src="https://i.vimeocdn.com/portrait/1274237_300x300">';
            }
            
        })
        ->addColumn('action', function($brand){
            return 
            '<a type="button" class="btn btn-success btn-edit" title="Edit" data-toggle="tooltip" data-url="'.asset('/admin/brands/find').'/'.$brand->id.'" id="post-edit"><span class="fa fa-edit" ></span></a>

            <a type="button" class="btn btn-danger btn-delete" title="Delete" data-toggle="tooltip" id="post-delete" data-url="'.asset('/admin/brands').'/'.$brand->id.'"><span class="fa fa-times"></span></a>';
        })

        ->rawColumns(['action','thumbnail'])
        ->toJson();
        
    }
}
